<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;

class SemesterController extends Controller
{
    public function index()
    {
        return view('admin.semester.index')
            ->with('semesters', Semester::paginate());
    }

    public function create()
    {
        return view('admin.semester.create');
    }

    public function store(StoreSemesterRequest $request)
    {
        $form = $request->safe()->only('semester');
        Semester::create($form);
        return redirect()->route('semester.index')->with('message', 'Berhasil tambah semester');
    }

    public function edit(Semester $semester)
    {
        return view('admin.semester.edit')
            ->with('semester', $semester);
    }

    public function update(UpdateSemesterRequest $request, Semester $semester)
    {
        $form = $request->safe()->only('semester');
        $semester->update($form);
        return redirect()->route('semester.index')->with('message', 'Berhasil ubah semester');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->route('semester.index')->with('message', 'Berhasil hapus semester');
    }
}
