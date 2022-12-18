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

    protected $fillable = ['sdm_id', 'check_in_time', 'check_out_time', 'created_at', 'updated_at'];

    public function human_resource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id', 'id');
    }

    public static function myPresence()
    {
        return self::detail(Auth::id());
    }

    public static function presences()
    {
        return HumanResource::leftJoin('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->whereIn('human_resources.id', User::getChildrenSdmId()->unique())
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
            )
            ->groupBy(
                'human_resources.sdm_name',
                'human_resources.id'
            )
            ->get();
    }

    public static function detail($sdm_id)
    {
        return self::where('sdm_id', $sdm_id)
            ->select(
                'id',
                'sdm_id',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour"),
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in_time, check_out_time)) as hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) % 60 as minutes')
            )
            ->groupBy('id')
            ->paginate();
    }
}
