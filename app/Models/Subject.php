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
        // ->where('class', '=', 'Math')
    }

    public function human_resource()
    {
        return $this->hasOne(HumanResource::class, 'id', 'sdm_id');
    }

    public static function selectOption()
    {
        return self::select('id as value', 'subject as text')->get();
    }

    public static function subjectAggregateId($sdm_id, $subject_id)
    {
        return self::select(
            'subjects.id',
            'subject',
            'sks',
            'number_of_meetings',
            'structure_id',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            // ->with('study_program')
            ->where('subjects.sdm_id', $sdm_id)
            ->where('subjects.id', $subject_id)
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'structure_id',
                'sdm_id'
            )
            ->first();
    }

    public static function byLecturerApi($sdm_id)
    {
        return self::select(
            'subjects.id',
            'subject',
            'sks',
            'number_of_meetings',
            'structure_id',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            // ->with('study_program')
            ->where('subjects.sdm_id', $sdm_id)
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'structure_id',
                'sdm_id'
            )
            ->get();
    }

    public static function today($sdm_id)
    {
        return self::select(
            'subjects.id',
            'subject',
            'sks',
            'number_of_meetings',
            'structure_id',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            // ->with('study_program')
            ->where('subjects.sdm_id', $sdm_id)
            ->whereHas('meetings', function ($query) {
                $query->whereDate('date', Carbon::today());
            })
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'structure_id',
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

    public static function byLecturer($sdm_id)
    {
        $result = self::select(
            'subjects.id',
            'subject',
            'sks',
            'number_of_meetings',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->where('sdm_id', $sdm_id)
            // ->with('study_program:id,role', 'human_resource:id,sdm_name')
            ->with('human_resource:id,sdm_name')
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

    public static function bySubDivision()
    {
        $result = self::select(
            'subjects.id',
            'subject',
            'class_id',
            'sks',
            'number_of_meetings',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->whereIn('sdm_id', User::getChildrenSdmId()->unique())
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

    public static function subjectBySdm($sdmId)
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
            ->where('sdm_id', $sdmId)
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
