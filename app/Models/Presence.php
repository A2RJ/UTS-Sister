<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public static function subPresenceByCivitas()
    {
        $search = request('search');
        $query = HumanResource::leftJoin('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->whereIn('human_resources.id', User::getChildrenSdmId())
            ->where('human_resources.id', '!=', Auth::id())
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
            )
            ->groupBy(
                'human_resources.sdm_name',
                'human_resources.id'
            );
        if ($search) {
            $query->when($search, function ($query) use ($search) {
                return $query->where('sdm_name', 'like', "%$search%");
            });
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

    public static function dsdmByCivitas()
    {
        $search = request('search');
        return HumanResource::leftJoin('presences', 'human_resources.id', '=', 'presences.sdm_id')
            // ->where('human_resources.id', '!=', Auth::id())
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
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
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
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
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
            )
            ->groupBy('id', 'sdm_id', 'latitude_in', 'longitude_in', 'latitude_out', 'longitude_out', 'check_in_date', 'check_out_date', 'check_in_hour', 'check_out_hour')
            ->get();
    }
}
