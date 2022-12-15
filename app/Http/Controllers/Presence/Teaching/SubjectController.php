<?php

namespace App\Http\Controllers\Presence\Teaching;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Classes;
use App\Models\HumanResource;
use App\Models\Meeting;
use App\Models\Structure;
use Illuminate\Support\Facades\DB;
use SubjectTrait;

class SubjectController extends Controller
{
    use SubjectTrait;

    public function index()
    {
        return view('presence.subject.index')
            ->with('subjects', Subject::allSubject());
    }

    public function create()
    {
        return view('presence.subject.create')
            ->with('study_programs', Structure::studyOption())
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

        return view('presence.subject.show')
            ->with('subject', $subject)
            ->with('meetings', $meetings);
    }

    public function edit(Subject $subject)
    {
        return view('presence.subject.edit')
            ->with('subject', $subject)
            ->with('study_programs', Structure::studyOption())
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

    public function mySubject()
    {
        return view('presence.subject.index')
            ->with('subjects', Subject::with('study_program', 'human_resource')->where('sdm_id', auth()->id())->paginate());
    }

    public function byLecturer($sdm_id)
    {
        return view('presence.subject.index')
            ->with('subjects', Subject::with('study_program', 'human_resource')->where('sdm_id', $sdm_id)->paginate());
    }
}
