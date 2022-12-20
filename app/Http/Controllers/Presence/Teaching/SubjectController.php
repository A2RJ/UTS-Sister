<?php

namespace App\Http\Controllers\Presence\Teaching;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Classes;
use App\Models\HumanResource;
use App\Models\Meeting;
use App\Models\Semester;
use App\Models\User;

class SubjectController extends Controller
{
    public function index()
    {
        return view('presence.subject.index')
            ->with('subjects', Subject::allSubject());
    }

    public function create()
    {
        $prodi = User::prodi();
        return view('presence.subject.create')
            ->with('study_program', $prodi)
            ->with('semesters', Semester::selectOption())
            ->with('classes', Classes::prodiSelectOption($prodi[0]->id))
            ->with('human_resources', HumanResource::selectAllOption());
    }

    public function store(StoreSubjectRequest $request)
    {
        $form = $request->safe()->only(["subject", "sks", "semester_id", "class_id", "number_of_meetings", "sdm_id"]);
        $subject = Subject::create($form);
        Meeting::bulkCreateMeetings($subject->id, $request->number_of_meetings);
        return redirect()->route('subject.index')->with('message', 'Berhasil tambah mata kuliah');
    }

    public function show(Subject $subject)
    {
        return view('presence.subject.show')
            ->with('subject', $subject)
            ->with('meetings', $subject->meetings);
    }

    public function edit(Subject $subject)
    {
        $prodi = User::prodi();
        return view('presence.subject.edit')
            ->with('subject', $subject)
            ->with('semesters', Semester::selectOption())
            ->with('study_program', User::prodi())
            ->with('classes', Classes::prodiSelectOption($prodi[0]->id))
            ->with('human_resources', HumanResource::selectOption());
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $form = $request->safe()->only(["subject", "sks", "class_id", "semester_id", "number_of_meetings", "sdm_id"]);
        $subject->update($form);
        return redirect()->route('subject.index')->with('message', 'Berhasil edit mata kuliah');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subject.index')->with('message', 'Berhasil delete mata kuliah');
    }

    public function mySubject()
    {
        return view('presence.subject.index')
            ->with('subjects', Subject::bySdmId([auth()->id()]));
    }

    public function byLecturer($sdm_id, $semester_id)
    {
        return view('presence.subject.index')
            ->with('subjects', Subject::bySdmId([$sdm_id], $semester_id));
    }

    public function subDivision()
    {
        return view('presence.subject.index')
            ->with('subjects', Subject::bySdmId(User::getChildrenSdmId()));
    }

    public function lecturerList()
    {
        return view('presence.civitas.index')
            ->with('human_resources', HumanResource::lecturerList());
    }
}
