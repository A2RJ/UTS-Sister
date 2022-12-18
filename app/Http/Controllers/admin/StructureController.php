<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Structure;
use App\Http\Requests\StructureRequest\StoreStructureRequest;
use App\Http\Requests\StructureRequest\UpdateStructureRequest;
use App\Traits\Utils\CustomPaginate;

class StructureController extends Controller
{
    use CustomPaginate;

    public function index()
    {
        return view('admin.structure.index')
            ->with('structures', Structure::search());
    }

    public function create()
    {
        return view('admin.structure.create')
            ->with('types', Structure::types())
            ->with('parent', Structure::selectOption());
    }

    public function store(StoreStructureRequest $request)
    {
        $form = $request->safe()->only(['role', 'parent_id', 'type']);
        $form['child_id'] = uniqid() . preg_replace("/\s+/", "", $request->role);
        Structure::create($form);
        return redirect()->route('structure.index')->with('message', 'Berhasil tambah jabatan struktural');
    }

    public function show(Structure $structure)
    {
        // return view('admin.structure.edit')
        //     ->with('structure', $structure)
        //     ->with('parent', Structure::select('id as value', 'role as text')->get());
    }

    public function edit(Structure $structure)
    {
        return view('admin.structure.edit')
            ->with('structure', $structure)
            ->with('types', Structure::types())
            ->with('parent', Structure::selectOption());
    }

    public function update(UpdateStructureRequest $request, Structure $structure)
    {
        $form = $request->safe()->only(['role', 'parent_id', 'type']);
        $structure->update($form);
        return redirect()->route('structure.index')->with('message', 'Berhasil update jabatan struktural');
    }

    public function destroy(Structure $structure)
    {
        $structure->delete();
        return redirect()->route('structure.index')->with('message', 'Berhasil delete jabatan struktural');
    }
}
