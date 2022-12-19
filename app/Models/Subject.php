<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'sks', 'number_of_meetings', 'class_id', 'semester_id', 'sdm_id'];

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

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    public static function selectOption()
    {
        return self::select('id as value', 'subject as text')->get();
    }

    public static function show($sdm_id, $subject_id)
    {
        return Subject::join('meetings', 'subjects.id', 'meetings.subject_id')
            ->join('human_resources', 'subjects.sdm_id', 'human_resources.id')
            ->join('semesters', 'subjects.semester_id', 'semesters.id')
            ->join('classes', 'subjects.class_id', 'classes.id')
            ->join('structures', 'classes.structure_id', 'structures.id')
            ->where('subjects.sdm_id', $sdm_id)
            ->where('subjects.id', $subject_id)
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
            ->with(['semester', 'human_resource:id,sdm_name', 'class' => function ($query) {
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
        $search = request('search');
        return Subject::join('meetings', 'subjects.id', 'meetings.subject_id')
            ->join('human_resources', 'subjects.sdm_id', 'human_resources.id')
            ->join('semesters', 'subjects.semester_id', 'semesters.id')
            ->join('classes', 'subjects.class_id', 'classes.id')
            ->join('structures', 'classes.structure_id', 'structures.id')
            ->when($search, function ($query) use ($search) {
                $query->where('subject', 'like', "%$search%")
                    ->orWhere('class', 'like', "%$search%")
                    ->orWhere('semester', 'like', "%$search%")
                    ->orWhere('sks', 'like', "%$search%")
                    ->orWhere('human_resources.sdm_name', 'like', "%$search%");
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
            ->paginate();
    }

    public static function bySdmId($sdm_id)
    {
        $search = request('search');
        return Subject::join('meetings', 'subjects.id', 'meetings.subject_id')
            ->join('human_resources', 'subjects.sdm_id', 'human_resources.id')
            ->join('semesters', 'subjects.semester_id', 'semesters.id')
            ->join('classes', 'subjects.class_id', 'classes.id')
            ->join('structures', 'classes.structure_id', 'structures.id')
            ->whereIn('subjects.sdm_id', $sdm_id)
            ->when($search, function ($query) use ($search) {
                $query->where('subject', 'like', "%$search%")
                    ->orWhere('class', 'like', "%$search%")
                    ->orWhere('semester', 'like', "%$search%")
                    ->orWhere('sks', 'like', "%$search%")
                    ->orWhere('human_resources.sdm_name', 'like', "%$search%");
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
            ->with(['semester', 'human_resource:id,sdm_name', 'class' => function ($query) {
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
        $data = Subject::join('human_resources', 'subjects.sdm_id', 'human_resources.id')
            ->join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->whereIn('human_resources.id', User::getChildrenSdmId()->unique())
            ->select('human_resources.id', 'semester_id', 'sdm_name', DB::raw('ROUND((SUM(CASE WHEN meetings.file IS NOT NULL OR meetings.meeting_start IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS total_sks'))
            ->with(['semester'])
            ->groupBy('human_resources.id', 'human_resources.sdm_name', 'semester_id')
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
