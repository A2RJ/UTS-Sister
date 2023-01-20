<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = ['sdm_id', 'check_in_time', 'check_out_time', 'latitude_in', 'longitude_in', 'latitude_out', 'longitude_out', 'created_at', 'updated_at'];

    public function human_resource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id', 'id');
    }

    public function processWeek(Request $request)
    {
        $start_week = $request->input('start');
        $end_week = $request->input('end');
        //validate input
        $validatedData = $request->validate([
            'start' => 'required|date_format:Y-W|before_or_equal:end',
            'end' => 'required|date_format:Y-W|after_or_equal:start',
        ]);

        // Mengubah input menjadi tanggal
        $start_date = Carbon::parse($start_week)->startOfWeek();
        $end_date = Carbon::parse($end_week)->endOfWeek();

        // Menampilkan hasil
        echo "Tanggal awal minggu: " . $start_date->toDateString() . "<br>";
        echo "Tanggal akhir minggu: " . $end_date->toDateString();
    }

    public static function expectedWorkingHours($sdm_type, $period)
    {
        $working_hours_per_week = 0;
        switch ($sdm_type) {
            case 'Dosen':
                $working_hours_per_week = 18;
                break;
            case 'Dosen DT':
                $working_hours_per_week = 30;
                break;
            case 'Tenaga Kependidikan':
                $working_hours_per_week = 35;
                break;
            case 'Security':
                $working_hours_per_week = 55;
                break;
            case 'Customer Service':
                $working_hours_per_week = 55;
                break;
            default:
                $working_hours_per_week = 0;
        }
        return $working_hours_per_week * $period * 60;
    }

    public static function calculatePeriod($start_date, $end_date)
    {
        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date);
        $days = $start->diffInDays($end);
        return $days / 7;
    }

    public static function subPresenceByCivitas()
    {
        $end = request('end');
        $start = request('start');
        $search = request('search');
        $thisWeek = request('thisweek');
        if ($thisWeek) {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        }
        $thisMonth = request('thismonth');
        if ($thisMonth) {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        }
        $period = self::calculatePeriod($start, $end);

        $query = HumanResource::leftJoin('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->whereIn('human_resources.id', User::getChildrenSdmId())
            ->where('human_resources.id', '!=', Auth::id())
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                'human_resources.sdm_type',
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time),0)) as hours'),
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time),0)) % 60 as minutes')
            )
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('presences.check_in_time', [$start, $end]);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('human_resources.sdm_name', 'like', "%$search%");
            })
            ->groupBy(
                'human_resources.sdm_name',
                'human_resources.id'
            );
        if ($thisWeek || $thisMonth) {
            $query->addSelect(
                DB::raw("CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((" . self::expectedWorkingHours('Dosen', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((" . self::expectedWorkingHours('Dosen DT', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((" . self::expectedWorkingHours('Tenaga Kependidikan', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((" . self::expectedWorkingHours('Security', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((" . self::expectedWorkingHours('Customer Service', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                ELSE 0
                END as hour_difference"),
                DB::raw("CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((" . self::expectedWorkingHours('Dosen', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((" . self::expectedWorkingHours('Dosen DT', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((" . self::expectedWorkingHours('Tenaga Kependidikan', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((" . self::expectedWorkingHours('Security', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((" . self::expectedWorkingHours('Customer Service', $period) . ") - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                ELSE 0
                END as minute_difference"),
                DB::raw("CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Dosen', $period) . ")), 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Dosen DT', $period) . ")), 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Tenaga Kependidikan', $period) . ")), 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Security', $period) . ")), 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Customer Service', $period) . ")), 0)
                ELSE 0
                END as overtime_minutes"),
                DB::raw("CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Dosen', $period) . ")) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Dosen DT', $period) . ")) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Tenaga Kependidikan', $period) . ")) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Security', $period) . ")) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (" . self::expectedWorkingHours('Customer Service', $period) . ")) DIV 60, 0)
                ELSE 0
                END as overtime_hours"),
            );
        } else {
            $query->addSelect(
                DB::raw("GREATEST(0, (CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((18*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((30*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((35*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                ELSE 0
                END)) as hour_difference"),
                DB::raw("GREATEST(0, (CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((18*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((30*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((35*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                ELSE 0
                    END)) as minute_difference"),
                DB::raw(
                    "GREATEST(0, (CASE
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (18*60)) DIV 60),0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (30*60)) DIV 60),0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (35*60)) DIV 60),0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (55*60)) DIV 60),0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (55*60)) DIV 60),0)
                ELSE 0
                END)) as overtime_hours"
                ),
                DB::raw("GREATEST(0, (CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (18*60)),0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (30*60)),0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (35*60)),0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (55*60)),0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (55*60)),0)
                ELSE 0
                END)) as overtime_minutes"),
            );
        }

        return $query->paginate();
    }

    public static function subPresenceAll()
    {
        return self::getPresences(User::justChildSDMId());
    }

    public static function getPresences($sdm_id)
    {
        $search = request('search');
        $start = request('start');
        $end = request('end');

        $query = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->whereIn('presences.sdm_id', $sdm_id)
            ->select(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'sdm_type',
                'latitude_in',
                'longitude_in',
                'latitude_out',
                'longitude_out',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour"),
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time),0)) as hours'),
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time),0)) % 60 as minutes')
            )
            ->groupBy(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'sdm_type',
                'latitude_in',
                'longitude_in',
                'latitude_out',
                'longitude_out',
                'check_in_date',
                'check_out_date',
                'check_in_hour',
                'check_out_hour'
            );
        if ($search) {
            $query->when($search, function ($query) use ($search) {
                return $query->where('sdm_name', 'like', "%$search%");
            });
        }

        if ($start && $end) {
            $query->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('check_in_time', [$start, $end]);
            });
        }
        return $query->paginate();
    }

    public static function dsdmByCivitas()
    {
        $search = request('search');
        return HumanResource::leftJoin('presences', 'human_resources.id', '=', 'presences.sdm_id')
            // ->where('human_resources.id', '!=', Auth::id())
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time),0)) as hours'),
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time),0)) % 60 as minutes')
            )
            ->when($search, function ($query) use ($search) {
                $query->where('sdm_name', 'like', "%$search%");
            })
            ->groupBy(
                'human_resources.sdm_name',
                'human_resources.id'
            )
            ->orderByDesc('hours')
            ->paginate();
    }

    public static function dsdmAllCivitas()
    {
        $search = request('search');
        $start = request('start');
        $end = request('end');
        $query = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
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
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time),0)) as hours'),
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time),0)) % 60 as minutes')
            )
            ->groupBy('presences.id', 'presences.sdm_id', 'sdm_name', 'latitude_in', 'longitude_in', 'latitude_out', 'longitude_out', 'check_in_date', 'check_out_date', 'check_in_hour', 'check_out_hour');
        if ($search) {
            $query->when($search, function ($query) use ($search) {
                return $query->where('sdm_name', 'like', "%$search%");
            });
        }

        if ($start && $end) {
            $query->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('check_in_time', [$start, $end]);
            });
        }
        return $query->paginate();
    }

    // API
    public static function myPresenceAPI($sdm_id)
    {
        return self::where('sdm_id', $sdm_id)
            ->select(
                'id',
                'sdm_id',
                'latitude_in',
                'longitude_in',
                'latitude_out',
                'longitude_out',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour"),
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time),0)) as hours'),
                DB::raw('SUM(IFNULL(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time),0)) % 60 as minutes')
            )
            ->groupBy('id', 'sdm_id', 'latitude_in', 'longitude_in', 'latitude_out', 'longitude_out', 'check_in_date', 'check_out_date', 'check_in_hour', 'check_out_hour')
            ->get();
    }
}
