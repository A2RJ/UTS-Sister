<?php

namespace App\Http\Controllers\Presence\Teaching;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest\StoreClassRequest;
use App\Http\Requests\ClassRequest\UpdateClassRequest;
use App\Models\Classes;
use App\Models\User; 

class ClassController extends Controller
{
    public function index()
    {
        return view('presence.class.index')
            ->with('classes', Classes::with('structure')->paginate());
    }

    public function create()
    {
        return view('presence.class.create')
            ->with('study_program', User::prodi());
    }

    public function store(StoreClassRequest $request)
    {
        $form = $request->safe()->only(['class']);
        $form['structure_id'] = User::prodi()[0]->id;
        Classes::create($form);
        return redirect()->route('class.index')->with('message', 'Berhasil tambah kelas');
    }

    public function edit(Classes $class)
    {
        return view('presence.class.edit')
            ->with('class', $class)
            ->with('study_program', User::prodi());
    }

    public function update(UpdateClassRequest $request, Classes $class)
    {
        $form = $request->safe()->only(['class']);
        $class->update($form);
        return redirect()->route('class.index')->with('message', 'Berhasil ubah kelas');
    }

    public function destroy(Classes $class)
    {
        $class->delete();
        return redirect()->route('class.index')->with('message', 'Berhasil hapus kelas');
    }
}
