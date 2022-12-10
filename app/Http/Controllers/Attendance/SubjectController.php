<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\HumanResource;
use App\Models\Meeting;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        return view('attendance.subject.index')
            ->with('subjects', Subject::with('study_program', 'human_resource')->paginate());
    }

    public function create()
    {
        return view('attendance.subject.create')
            ->with('study_programs', StudyProgram::selectOption())
            ->with('human_resources', HumanResource::selectOption());
    }

    public function store(StoreSubjectRequest $request)
    {
        $form = $request->safe()->only(["subject", "sks", "number_of_meetings", "study_program_id", "sdm_id"]);
        $subject = Subject::create($form);
        Meeting::bulkCreateMeetings($subject->id, $request->number_of_meetings);
        return redirect(route('subject.index'))->with('message', 'Berhasil tambah mata kuliah');
    }

    public function show(Subject $subject)
    {
        return view('attendance.subject.show')
            ->with('subject', $subject);
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
        $form = $request->safe()->only(["subject", "sks", "number_of_meetings", "study_program_id", "sdm_id"]);
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
        $results = Subject::join('meetings', 'meetings.subject_id', 'subjects.id')
            ->select(
                'subjects.*',
                DB::raw('SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) AS number_of_taken'),
                DB::raw('SUM(CASE WHEN meetings.file_start IS NULL OR meetings.file_end IS NULL THEN 1 ELSE 0 END) AS number_of_not_taken'),
                DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks')
            )
            ->where('subjects.sdm_id', $request->user()->id)
            ->with('study_program')
            ->groupBy('subjects.id')
            ->paginate();
        return response($results);
    }

    public function subjectAggregateId(Request $request, $subject_id)
    {
        $results = Subject::join('meetings', 'meetings.subject_id', 'subjects.id')
            ->select(
                'subjects.*',
                DB::raw('SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) AS number_of_taken'),
                DB::raw('SUM(CASE WHEN meetings.file_start IS NULL OR meetings.file_end IS NULL THEN 1 ELSE 0 END) AS number_of_not_taken'),
                DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks')
            )
            ->where('subjects.sdm_id', $request->user()->id)
            ->where('subjects.id', $subject_id)
            ->with('study_program')
            ->groupBy('subjects.id')
            ->first();
        return response($results);
    }
}
