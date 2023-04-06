<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use App\Models\HumanResource;
use App\Models\Presence;
use App\Models\Structure;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class FilePresenceController extends Controller
{

    public function getPresence($sdm_id)
    {
        $search = request('search');
        $start = request('start');
        $end = request('end');

        return Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->whereIn('presences.sdm_id', $sdm_id)
            ->where(function ($query) use ($search, $start, $end) {
                if ($search) {
                    $query->where('sdm_name', 'like', "%$search%");
                }

                if ($start && $end) {
                    $query->whereBetween('check_in_time', [$start, $end]);
                }
            })
            ->select(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'latitude_in',
                'longitude_in',
                'latitude_out',
                'longitude_out',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour"),
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
            )
            ->groupBy('presences.id', 'presences.sdm_id', 'sdm_name', 'latitude_in', 'longitude_in', 'latitude_out', 'longitude_out', 'check_in_date', 'check_out_date', 'check_in_hour', 'check_out_hour')
            ->get();
    }

    public function myPresence()
    {
        return (new FastExcel($this->getPresence([Auth::id()])))->download('laporan-kehadiran-' . Auth::user()->sdm_name  . '-' . Carbon::now() . '.xlsx', function ($sdm) {
            $hours = $sdm['hours'] ?? 0;
            $minutes = $sdm['minutes'] ?? 0;
            return [
                'Nama SDM' => $sdm['sdm_name'],
                'Tanggal' => $sdm['check_in_date'],
                'Jam Masuk' => $sdm['check_in_hour'],
                'Jam Pulang' => $sdm['check_out_hour'],
                'Durasi' => $hours . ' Jam ' . $minutes . ' Menit'
            ];
        });
    }

    public function perCivitas()
    {
        $search = request('search');
        $result = HumanResource::leftJoin('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->where(function ($query) use ($search) {
                $query->whereIn('human_resources.id', Structure::getSdmIdOneLevelUnder());
                if ($search) {
                    $query->where('sdm_name', 'like', "%$search%");
                }
            })
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
            )
            ->workHour()
            ->groupBy(
                'human_resources.sdm_name',
                'human_resources.id',
                'human_resources.sdm_type'
            )
            ->get();

        return (new FastExcel($result))->download('laporan-kehadiran-per-dosen-' . Carbon::now() . '.xlsx', function ($sdm) {
            $hours = $sdm['hours'] ?? 0;
            $minutes = $sdm['minutes'] ?? 0;
            return [
                'Nama SDM' => $sdm['sdm_name'],
                'Total Jam' => $hours . ' Jam ' . $minutes . ' Menit',
                'Kurang' => $sdm['effective_hours'],
                // 'Lembur' => $sdm['ineffective_hours']
            ];
        });
    }

    public function subPresenceAll()
    {
        return (new FastExcel($this->getPresence(Structure::getSdmIdOneLevelUnder())))->download('laporan-kehadiran-' . Carbon::now() . '.xlsx', function ($sdm) {
            $hours = $sdm['hours'] ?? 0;
            $minutes = $sdm['minutes'] ?? 0;
            return [
                'Nama SDM' => $sdm['sdm_name'],
                'Tanggal' => $sdm['check_in_date'],
                'Jam Masuk' => $sdm['check_in_hour'],
                'Jam Pulang' => $sdm['check_out_hour'],
                'Durasi' => $hours . ' Jam ' . $minutes . ' Menit'
            ];
        });
    }

    public function detail($sdm_id)
    {
        $sdm = HumanResource::where('id', $sdm_id)->first();
        return (new FastExcel($this->getPresence([$sdm_id])))->download('laporan-kehadiran-' . $sdm->sdm_name . '-' . Carbon::now() . '.xlsx', function ($sdm) {
            $hours = $sdm['hours'] ?? 0;
            $minutes = $sdm['minutes'] ?? 0;
            return [
                'Nama SDM' => $sdm['sdm_name'],
                'Tanggal' => $sdm['check_in_date'],
                'Jam Masuk' => $sdm['check_in_hour'],
                'Jam Pulang' => $sdm['check_out_hour'],
                'Durasi' => $hours . ' Jam ' . $minutes . ' Menit'
            ];
        });
    }

    public function dsdmByCivitas()
    {
        $search = request('search');
        $start = request('start');
        $end = request('end');

        $result = HumanResource::leftJoin('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
            )
            ->when($search, function ($query) use ($search) {
                $query->where('sdm_name', 'like', "%$search%");
            })
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('check_in_time', [$start, $end]);
            })
            ->workHour()
            ->groupBy(
                'human_resources.sdm_name',
                'human_resources.id',
                'human_resources.sdm_type'
            )
            ->get();

        return (new FastExcel($result))->download('laporan-kehadiran-per-dosen-' . Carbon::now() . '.xlsx', function ($sdm) {
            $hours = $sdm['hours'] ?? 0;
            $minutes = $sdm['minutes'] ?? 0;
            return [
                'Nama SDM' => $sdm['sdm_name'],
                'Total Jam' => $hours . ' Jam ' . $minutes . ' Menit',
                'Kurang' => $sdm['effective_hours'],
                // 'Lembur' => $sdm['ineffective_hours']
            ];
        });
    }

    public function dsdmAllCivitas()
    {
        $search = request('search');
        $start = request('start');
        $end = request('end');
        $result = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->select(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'latitude_in',
                'longitude_in',
                'latitude_out',
                'longitude_out',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour"),
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
            )
            ->when($search, function ($query) use ($search) {
                $query->where('sdm_name', 'like', "%$search%");
            })
            ->when($start && $end, function ($query) use ($start, $end) {
                $query->whereBetween('check_in_time', [$start, $end]);
            })
            ->groupBy(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'latitude_in',
                'longitude_in',
                'latitude_out',
                'longitude_out',
                'check_in_date',
                'check_out_date',
                'check_in_hour',
                'check_out_hour'
            )
            ->get();

        return (new FastExcel($result))->download('laporan-kehadiran-' . Carbon::now() . '.xlsx', function ($sdm) {
            $hours = $sdm['hours'] ?? 0;
            $minutes = $sdm['minutes'] ?? 0;
            return [
                'Nama SDM' => $sdm['sdm_name'],
                'Tanggal' => $sdm['check_in_date'],
                'Jam Masuk' => $sdm['check_in_hour'],
                'Jam Pulang' => $sdm['check_out_hour'],
                'Durasi' => $hours . ' Jam ' . $minutes . ' Menit'
            ];
        });
    }


    public function subLecturer()
    {
        $search = request('search');
        $sdm_id = Structure::getSdmIdOneLevelUnder();
        $result = Subject::join('human_resources', 'subjects.sdm_id', 'human_resources.id')
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->join('semesters', 'subjects.semester_id', 'semesters.id')
            ->where(function ($query) use ($sdm_id) {
                $query->whereIn('human_resources.id', $sdm_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('sdm_name', 'like', "%$search%")
                    ->orWhere('semester', 'like', "%$search%");
            })
            ->select('human_resources.id', 'semester_id', 'semester', 'sdm_name', DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS total_sks'))
            ->groupBy('human_resources.id', 'human_resources.sdm_name', 'semester_id', 'semester')
            ->get();

        return (new FastExcel($result))->download('laporan-pengajaran-dosen-' . Carbon::now() . '.xlsx', function ($sdm) {
            return [
                'Nama SDM' => $sdm['sdm_name'],
                'Semester' => $sdm['semester'],
                'Total SKS' => $sdm['total_sks'],
            ];
        });
    }

    public function byLecturer($sdm_id, $semester_id)
    {
        $sdm = HumanResource::where('id', $sdm_id)->first();
        $search = request('search');
        $result =  Subject::join('meetings', 'subjects.id', 'meetings.subject_id')
            ->join('human_resources', 'subjects.sdm_id', 'human_resources.id')
            ->join('semesters', 'subjects.semester_id', 'semesters.id')
            ->join('classes', 'subjects.class_id', 'classes.id')
            ->join('structures', 'classes.structure_id', 'structures.id')
            ->where('subjects.sdm_id', $sdm_id)
            ->where(function ($query) use ($search) {
                $query->where('subject', 'like', "%$search%")
                    ->orWhere('class', 'like', "%$search%")
                    ->orWhere('semester', 'like', "%$search%")
                    ->orWhere('sks', 'like', "%$search%")
                    ->orWhere('human_resources.sdm_name', 'like', "%$search%");
            })
            ->when($semester_id, function ($query) use ($semester_id) {
                $query->where('subjects.semester_id', $semester_id);
            })
            ->select(
                'subjects.id',
                'subject as subject_name',
                'class as class_name',
                'role as study_program',
                'semester',
                'sks',
                'number_of_meetings',
                'subjects.sdm_id',
                'human_resources.sdm_name',
                DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
                DB::raw('COUNT(meetings.meeting_start) AS meetings_completed'),
                DB::raw('COUNT(*) - COUNT(meetings.meeting_start) AS meetings_pending')
            )
            ->groupBy(
                'subjects.id',
                'subject',
                'class',
                'role',
                'semester',
                'sks',
                'number_of_meetings',
                'subjects.sdm_id',
                'human_resources.sdm_name'
            )
            ->get();
        return (new FastExcel($result))->download('laporan-pengajaran-' . $sdm->sdm_name . Carbon::now() . '.xlsx', function ($sdm) {
            return [
                'Nama Mata Kuliah' => $sdm['subject_name'],
                'Nama Kelas' => $sdm['class_name'],
                'Program Study' => $sdm['study_program'],
                'Semester' => $sdm['semester'],
                'SKS' => $sdm['sks'],
                'Jumlah pertemuan' => $sdm['number_of_meetings'],
                'Jumlah pertemuan Selesai' => $sdm['meetings_completed'],
                'Jumlah pertemuan Belum Selesai' => $sdm['meetings_pending'],
                'Nilai SKS' => $sdm['value_sks'],
            ];
        });
    }

    public function allLecturer()
    {
        $search = request('search');
        $result = Subject::join('human_resources', 'subjects.sdm_id', 'human_resources.id')
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->join('semesters', 'subjects.semester_id', 'semesters.id')
            ->when($search, function ($query) use ($search) {
                $query->where('sdm_name', 'like', "%$search%")
                    ->orWhere('semester', 'like', "%$search%");
            })
            ->select('human_resources.id', 'semester_id', 'semester', 'sdm_name', DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS total_sks'))
            ->groupBy('human_resources.id', 'human_resources.sdm_name', 'semester_id', 'semester')
            ->get();

        return (new FastExcel($result))->download('laporan-pengajaran-dosen-' . Carbon::now() . '.xlsx', function ($sdm) {
            return [
                'Nama SDM' => $sdm['sdm_name'],
                'Semester' => $sdm['semester'],
                'Total SKS' => $sdm['total_sks'],
            ];
        });
    }
}
