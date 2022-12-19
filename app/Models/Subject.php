<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'sks', 'number_of_meetings', 'class_id', 'sdm_id'];

    public $timestamps = false;

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function human_resource()
    {
        return $this->hasOne(HumanResource::class, 'id', 'sdm_id');
    }

    public static function selectOption()
    {
        return self::select('id as value', 'subject as text')->get();
    }

    public static function show($sdm_id, $subject_id)
    {
        return self::select(
            'subjects.id',
            'subject',
            'class_id',
            'sks',
            'number_of_meetings',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.meeting_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.meeting_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->where('subjects.sdm_id', $sdm_id)
            ->where('subjects.id', $subject_id)
            ->with(['human_resource:id,sdm_name', 'class' => function ($query) {
                $query->select('id', 'class', 'structure_id')
                    ->with('structure:id,role');
            }])
            ->groupBy(
                'subjects.id',
                'subject',
                'class_id',
                'sks',
                'number_of_meetings',
                'sdm_id'
            )
            ->first();
    }

    public static function today($sdm_id)
    {
        return self::select(
            'subjects.id',
            'subject',
            'class_id',
            'sks',
            'number_of_meetings',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.meeting_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.meeting_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->with(['human_resource:id,sdm_name', 'class' => function ($query) {
                $query->select('id', 'class', 'structure_id')
                    ->with('structure:id,role');
            }])
            ->where('subjects.sdm_id', $sdm_id)
            ->whereHas('meetings', function ($query) {
                $query->whereDate('date', Carbon::today())
                    ->whereNull('meeting_start');
            })
            ->groupBy(
                'subjects.id',
                'subject',
                'class_id',
                'sks',
                'number_of_meetings',
                'sdm_id'
            )
            ->get();
    }

    public static function allSubject()
    {
        $result = self::select(
            'subjects.id',
            'subject',
            'class_id',
            'sks',
            'number_of_meetings',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.meeting_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.meeting_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->with(['human_resource:id,sdm_name', 'class' => function ($query) {
                $query->select('id', 'class', 'structure_id')
                    ->with('structure:id,role');
            }])
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'sdm_id'
            )
            ->paginate();

        return $result;
    }

    public static function bySdmId($sdm_id)
    {
        return Subject::select(
            'subjects.id',
            'subject',
            'class_id',
            'sks',
            'number_of_meetings',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.meeting_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.meeting_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->with(['human_resource:id,sdm_name', 'class' => function ($query) {
                $query->select('id', 'class', 'structure_id')
                    ->with('structure:id,role');
            }])
            ->whereIn('sdm_id', $sdm_id)
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'sdm_id'
            )
            ->paginate();
    }

    public static function bySdmIdAPI($sdm_id)
    {
        return Subject::select(
            'subjects.id',
            'subject',
            'class_id',
            'sks',
            'number_of_meetings',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.meeting_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.meeting_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->with(['human_resource:id,sdm_name', 'class' => function ($query) {
                $query->select('id', 'class', 'structure_id')
                    ->with('structure:id,role');
            }])
            ->whereIn('sdm_id', $sdm_id)
            ->groupBy(
                'subjects.id',
                'subject',
                'class_id',
                'sks',
                'number_of_meetings',
                'sdm_id'
            )
            ->get();
    }

    public static function subLecturer()
    {
        $data = HumanResource::join('subjects', 'human_resources.id', 'subjects.sdm_id')
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->whereIn('human_resources.id', User::getChildrenSdmId()->unique())
            ->select('human_resources.id', 'sdm_name', DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS total_sks'))
            ->groupBy('human_resources.id', 'human_resources.sdm_name')
            ->paginate();
        return $data;
    }

    public static function lecturer()
    {
        $data = HumanResource::join('subjects', 'human_resources.id', 'subjects.sdm_id')
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->select('human_resources.id', 'sdm_name', DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS total_sks'))
            ->groupBy('human_resources.id', 'human_resources.sdm_name')
            ->paginate();
        return $data;
    }
}
