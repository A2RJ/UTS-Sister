<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Classes;
use App\Models\HumanResource;
use App\Models\Meeting;
use App\Models\StudyProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::select(
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
            ->with('study_program:id,study_program', 'human_resource:id,sdm_name') //, 'meetings'
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'study_program_id',
                'sdm_id'
            )
            ->paginate();


        return view('attendance.subject.index')
            ->with('subjects', $subjects);
    }

    public function create()
    {
        return view('attendance.subject.create')
            ->with('study_programs', StudyProgram::selectOption())
            ->with('classes', Classes::selectOption())
            ->with('human_resources', HumanResource::selectOption());
    }

    public function store(StoreSubjectRequest $request)
    {
        $form = $request->safe()->only(["subject", "sks", "class_id", "number_of_meetings", "study_program_id", "sdm_id"]);
        $subject = Subject::create($form);
        Meeting::bulkCreateMeetings($subject->id, $request->number_of_meetings);
        return redirect(route('subject.index'))->with('message', 'Berhasil tambah mata kuliah');
    }

    public function show(Subject $subject)
    {
        $meetings = Subject::join('meetings', 'subjects.id', '=', 'meetings.subject_id')
            ->select('subjects.*', 'meetings.*', DB::raw('TIMESTAMPDIFF(MINUTE, meetings.meeting_start, meetings.meeting_end) AS meeting_duration'))
            ->where('subjects.id', $subject->id)
            ->get();

        return view('attendance.subject.show')
            ->with('subject', $subject)
            ->with('meetings', $meetings);
    }

    public function edit(Subject $subject)
    {
        return view('attendance.subject.edit')
            ->with('subject', $subject)
            ->with('study_programs', StudyProgram::selectOption())
            ->with('human_resources', HumanResource::selectOption());
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $form = $request->safe()->only(["subject", "sks", "class_id", "number_of_meetings", "study_program_id", "sdm_id"]);
        $subject->update($form);
        return redirect(route('subject.index'))->with('message', 'Berhasil edit mata kuliah');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect(route('subject.index'))->with('message', 'Berhasil delete mata kuliah');
    }

    public function byLecturer()
    {
        return view('attendance.subject.index')
            ->with('subjects', Subject::with('study_program', 'human_resource')->where('sdm_id', auth()->id())->paginate());
    }

    public function byLecturerApi(Request $request)
    {
        $results = Subject::select(
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
            ->with('study_program') //, 'meetings'
            ->where('subjects.sdm_id', $request->user()->id)
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'study_program_id',
                'sdm_id'
            )
            ->get();

        return response([
            'data' => $results
        ]);
    }

    public function subjectAggregateId(Request $request, $subject_id)
    {
        $results = Subject::select(
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
            ->with('study_program') //, 'meetings'
            ->where('subjects.sdm_id', $request->user()->id)
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

        return response([
            'data' => $results
        ]);
    }

    public function today(Request $request)
    {
        $results = Subject::select(
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
            ->with('study_program') //, 'meetings'
            ->where('subjects.sdm_id', $request->user()->id)
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

        return response([
            'data' => $results
        ]);
    }
}
