<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'sdm_id',
        'check_in_time',
        'latitude_in',
        'longitude_in',
        'check_out_time',
        'latitude_out',
        'longitude_out',
        'permission'
    ];
    static $latitude = 80;
    static $longitude = 80;
    static $jenisIzin = [
        'Tidak Masuk',
        'Izin Berkegiatan Diluar 1/2 Hari',
        'Izin Berkegiatan Diluar 1 Hari',
        'Izin Sakit',
        'Terkendala Absen Masuk',
        'Terkendala Absen Pulang',
    ];
    static $workingTime = [
        'Dosen' => 18,
        'Dosen DT' => 30,
        'Tenaga Kependidikan' => 35,
        'Security' => 55,
        'Customer Service' => 55,
    ];

    public static function workHour($sdm_type)
    {
        $workHour = [
            'Dosen' => [
                'in' => "07:00",
                'out' => "19:00",
            ],
            'Dosen DT' => [
                'in' => "07:00",
                'out' => "19:00",
            ],
            'Tenaga Kependidikan' => [
                'in' => "09:00",
                'out' => "16:00",
            ],
            'Security 1' => [
                'in' => "17:00",
                'out' => "06:00",
            ],
            'Security 2' => [
                'in' => "06:00",
                'out' => "17:00",
            ],
            'Customer Service' => [
                'in' => "07:00",
                'out' => "17:00",
            ],
        ];
        if (!array_key_exists(Str::title($sdm_type), $workHour))  throw new Exception('Invalid sdm_type' . $sdm_type);
        return $workHour[Str::title($sdm_type)];
    }

    public static function isLate($sdm_type)
    {
        return Carbon::now()->format('H:i') > Presence::workHour($sdm_type)['in'];
    }

    public function humanResource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id', 'id');
    }

    public function attachment()
    {
        return $this->hasOne(PresenceAttachment::class, 'presence_id');
    }

    public function structure()
    {
        return $this->hasManyThrough(
            Structure::class,
            StructuralPosition::class,
            'sdm_id', // Foreign key on struktural table...
            'id', // Foreign key on structure table...
            'sdm_id', // Local key on presence table...
            'structure_id' // Local key on struktural table...
        );
    }

    public function roles()
    {
        return $this->structure
            ->pluck('role')
            ->reject(function ($role) {
                return $role === 'admin';
            })
            ->implode(', <br>');
    }

    public function detail()
    {
        $words = explode(' ', $this->attachment->detail);
        $lineCount = count($words) / 5;
        $result = '';

        for ($i = 0; $i < $lineCount; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $index = $i * 5 + $j;
                if (isset($words[$index])) {
                    $result .= $words[$index] . ' ';
                }
            }
            $result .= "<br>";
        }

        return $result;
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
        $working_hours_per_week = $sdm_type ? self::$workingTime[$sdm_type] : 0;
        return $working_hours_per_week * $period * 60;
    }

    public static function calculatePeriod($start_date, $end_date)
    {
        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date);
        $days = $start->diffInDays($end);
        return $days / 7;
    }

    public static function subPresence()
    {
        $filter = request('filter');
        $oneLevelUnder = request('one-level');
        if ($oneLevelUnder) $sdmIds = Structure::getSdmIdOneLevelUnder();
        else $sdmIds = Structure::getSdmIdAllLevelUnder();

        if ($filter === 'per-unit') {
            if ($oneLevelUnder) $structureId = Structure::getIdsOneLevelUnder();
            else $structureId = Structure::getAllIdsLevelUnder();
            return Presence::perUnit($structureId);
        } elseif ($filter === 'per-civitas') {
            return Presence::perCivitas($sdmIds);
        } else {
            return Presence::getAllPresences($sdmIds);
        }
    }

    public static function dsdmPresence()
    {
        $filter = request('filter');

        if ($filter === 'per-unit') {
            return Presence::perUnit();
        } elseif ($filter === 'per-civitas') {
            return Presence::perCivitas();
        } else {
            return Presence::getAllPresences();
        }
    }

    public static function perUnit($structureId = false)
    {
        $search = request('search');
        $result = Structure::whereNot('role', 'admin')
            ->when($structureId, function ($query) use ($structureId) {
                return $query->whereIn('id', $structureId);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('role', 'LIKE', "%$search%");
            })
            ->paginate()
            ->appends(request()->except('page'));

        return $result;
    }

    public static function perCivitas($sdmIds = false)
    {
        $end = request('end');
        $start = request('start');
        $search = request('search');
        $isSearchROle = Str::contains($search, ':');
        $role = $isSearchROle ? str_replace(':', '', $search) : '';

        $query = HumanResource::join('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                'human_resources.nidn',

            )
            ->workHours()
            ->when($sdmIds, function ($query) use ($sdmIds) {
                return $query->whereIn('human_resources.id', $sdmIds);
            })
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('presences.check_in_time', [$start, $end]);
            })
            ->when($search && !$isSearchROle, function ($query) use ($search) {
                return $query->where('human_resources.sdm_name', 'like', "%$search%");
            })
            ->when($isSearchROle, function ($query) use ($role) {
                return $query->where('human_resources.sdm_type', 'like', "%$role%");
            })
            ->groupBy(
                'human_resources.id',
                'human_resources.sdm_name',
                'human_resources.nidn',
            );

        return $query->paginate()
            ->appends(request()->except('page'));
    }

    public static function getAllPresences($sdmIds = false)
    {
        $search = request('search');
        $start = request('start');
        $end = request('end');

        $isSearchROle = Str::contains($search, ':');
        $role = $isSearchROle ? str_replace(':', '', $search) : '';

        $query = HumanResource::join('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->select(
                'human_resources.id',
                'human_resources.sdm_name',
                'human_resources.nidn',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour")
            )
            ->workHours()
            ->when($sdmIds, function ($query) use ($sdmIds) {
                return $query->whereIn('human_resources.id', $sdmIds);
            })
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('presences.check_in_time', [$start, $end]);
            })
            ->when($search && !$isSearchROle, function ($query) use ($search) {
                return $query->where('human_resources.sdm_name', 'like', "%$search%");
            })
            ->when($isSearchROle, function ($query) use ($role) {
                return $query->where('human_resources.sdm_type', 'like', "%$role%");
            })
            ->groupBy(
                'human_resources.id',
                'human_resources.sdm_name',
                'human_resources.nidn',
                'check_in_time',
                'check_out_time'
            );

        return $query->paginate()
            ->appends(request()->except('page'));
    }

    public static function totalPresenceHour($isSdmOrAdmin = false)
    {
        $sdmIds = [];
        if (!$isSdmOrAdmin) {
            $oneLevelUnder = request('one-level');
            if ($oneLevelUnder) $sdmIds = Structure::getSdmIdOneLevelUnder();
            else $sdmIds = Structure::getSdmIdAllLevelUnder();
        }

        $start = request('start');
        $end = request('end');

        return HumanResource::join('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->when(!$isSdmOrAdmin, function ($query) use ($sdmIds) {
                return $query->whereIn('human_resources.id', $sdmIds);
            })
            ->workHours()
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('check_in_time', [$start, $end]);
            })
            ->first();
    }

    /**
     * Permission
     */
    public static function myPermission()
    {
        $result = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->where('presences.sdm_id', Auth::id())
            ->where('permission', 0)
            ->with('attachment')
            ->select(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'presences.created_at'
            )
            ->groupBy(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'presences.created_at'
            )
            ->paginate()
            ->appends(request()->except('page'));

        return $result;
    }

    public static function subPermission()
    {
        $sdmId = Structure::getSdmIdOneLevelUnder();
        $result = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->whereIn('presences.sdm_id', $sdmId)
            ->where('permission', 0)
            ->with(['attachment', 'humanResource'])
            ->select(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'presences.created_at'
            )
            ->groupBy(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'presences.created_at'
            )
            ->paginate()
            ->appends(request()->except('page'));

        return $result;
    }

    // API
    public static function myPresenceAPI($sdm_id)
    {
        $start = request('start');
        $end = request('end');

        if (!$start) $start = Carbon::now()->startOfWeek();
        if (!$end) $end = Carbon::now()->endOfWeek();

        return Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->select(
                'presences.id',
                'presences.sdm_id',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour")
            )
            ->workHours()
            ->where('presences.sdm_id', $sdm_id)
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('check_in_time', [$start, $end]);
            })
            ->groupBy(
                'presences.id',
                'presences.sdm_id',
                'presences.check_in_time',
                'presences.check_out_time'
            )
            ->get();
    }


    public static function getPresenceHours($sdm_id, $isWeb = false)
    {
        $start = request('start', Carbon::now()->startOfWeek());
        $end = request('end', Carbon::now()->endOfWeek());

        $query = HumanResource::join('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->where('human_resources.id', $sdm_id)
            ->workHours()
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('check_in_time', [$start, $end]);
            });

        if ($isWeb) return $query->first();
        return $query->select(
            'human_resources.sdm_name',
            'human_resources.id'
        )
            ->groupBy(
                'human_resources.sdm_name',
                'human_resources.id',
                'human_resources.sdm_type'
            )
            ->first();
    }
}
