<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Http\Requests\FacultyRequest\StoreFacultyRequest;
use App\Http\Requests\FacultyRequest\UpdateFacultyRequest;

class FacultyController extends Controller
{
    public function index()
    {
        return view('attendance.faculty.index')
            ->with('faculties', Faculty::search());
    }

    public function create()
    {
        return view('attendance.faculty.create');
    }

    public function store(StoreFacultyRequest $request)
    {
        $form = $request->safe()->only(['faculty']);
        Faculty::create($form);
        return redirect(route('faculty.index'))->with('message', 'Berhasil menambah' . $request->faculty);
    }

    public function edit(Faculty $faculty)
    {
        return view('attendance.faculty.edit')->with('faculty', $faculty);
    }

    public function update(UpdateFacultyRequest $request, Faculty $faculty)
    {
        $form = $request->safe()->only(['faculty']);
        $faculty->update($form);
        return redirect(route('faculty.index'))->with('message', 'Berhasil update ' . $request->faculty);
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect(route('faculty.index'))->with('message', 'Berhasil hapus fakultas');
    }
}
