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

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
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
            'study_program_id',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->with('study_program')
            ->where('subjects.sdm_id', $sdm_id)
            ->where('subjects.id', $subject_id)
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'study_program_id',
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
            'study_program_id',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->with('study_program')
            ->where('subjects.sdm_id', $sdm_id)
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'study_program_id',
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
            'study_program_id',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file_start) AS meetings_pending')
        )
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->with('study_program')
            ->where('subjects.sdm_id', $sdm_id)
            ->whereHas('meetings', function ($query) {
                $query->whereDate('date', Carbon::today());
            })
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'study_program_id',
                'sdm_id'
            )
            ->get();
    }

    public static function allSubject()
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
            ->with('study_program:id,study_program', 'human_resource:id,sdm_name')
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
            ->with('study_program:id,study_program', 'human_resource:id,sdm_name')
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

    public static function lecturer()
    {
        $roles = User::hasSub();
        if ($roles && count($roles) === 0) return false;
        $data = Structure::join('structural_positions', 'structures.id', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', 'human_resources.id')
            ->select('structures.id', 'human_resources.id as sdm_id', 'structures.role', 'structures.type', 'human_resources.sdm_name')
            ->where('structures.type', 'dosen')
            ->whereIn('structures.id', collect($roles)->pluck('id')->toArray())
            ->paginate();
        return $data;
    }
}
