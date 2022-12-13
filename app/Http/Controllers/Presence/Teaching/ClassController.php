<?php

namespace App\Http\Controllers\Presence\Teaching;

use App\Http\Controllers\Controller;
use App\Http\Requests\Class\StoreClassRequest;
use App\Http\Requests\Class\UpdateClassRequest;
use App\Models\Classes;
use App\Models\StudyProgram;

class ClassController extends Controller
{
    public function index()
    {
        return view('presence.class.index')
            ->with('classes', Classes::with('study_program')->paginate());
    }

    public function create()
    {
        return view('presence.class.create')
            ->with('study_program', StudyProgram::selectOption());
    }

    public function store(StoreClassRequest $request)
    {
        $form = $request->safe()->only(['class', 'study_program_id']);
        Classes::create($form);
        return redirect(route('class.index'))->with('message', 'Berhasil tambah kelas');
    }

    public function show(Classes $class)
    {
    }

    public function edit(Classes $class)
    {
        return view('presence.class.edit')
            ->with('class', $class)
            ->with('study_program', StudyProgram::selectOption());
    }

    public function update(UpdateClassRequest $request, Classes $class)
    {
        $form = $request->safe()->only(['class', "study_program_id"]);
        $class->update($form);
        return redirect(route('class.index'))->with('message', 'Berhasil ubah kelas');
    }

    public function destroy(Classes $class)
    {
        $class->delete();
        return redirect(route('class.index'))->with('message', 'Berhasil hapus kelas');
    }
}
