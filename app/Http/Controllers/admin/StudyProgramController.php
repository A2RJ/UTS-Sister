<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use App\Http\Requests\StudyProgram\StoreStudyProgramRequest;
use App\Http\Requests\StudyProgram\UpdateStudyProgramRequest;
use App\Models\Faculty;

class StudyProgramController extends Controller
{
    public function index()
    {
        return view('attendance.study_program.index')
            ->with('study_programs', StudyProgram::paginate());
    }

    public function create()
    {
        return view('attendance.study_program.create')
            ->with('faculties', Faculty::selectOption());
    }

    public function store(StoreStudyProgramRequest $request)
    {
        $form = $request->safe()->only(['study_program', 'faculty_id']);
        StudyProgram::create($form);
        return redirect(route('study_program.index'))->with('message', 'Berhasil tambah program studi');
    }

    public function show(StudyProgram $studyProgram)
    {
        //
    }

    public function edit(StudyProgram $studyProgram)
    {
        return view('attendance.study_program.edit')
            ->with('study_program', $studyProgram)
            ->with('faculties', Faculty::selectOption());
    }

    public function update(UpdateStudyProgramRequest $request, StudyProgram $studyProgram)
    {
        $form = $request->safe()->only(['study_program', 'faculty_id']);
        $studyProgram->update($form);
        return redirect(route('study_program.index'))->with('message', 'Berhasil edit program studi');
    }

    public function destroy(StudyProgram $studyProgram)
    {
        $studyProgram->delete();
        return redirect(route('study_program.index'))->with('message', 'Berhasil delete program studi');
    }
}
