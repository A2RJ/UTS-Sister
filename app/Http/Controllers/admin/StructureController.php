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
        return view('attendance.structure.index')
            ->with('structures', Structure::search());
    }

    public function create()
    {
        return view('attendance.structure.create')
            ->with('types', Structure::type())
            ->with('parent', Structure::selectOption());
    }

    public function store(StoreStructureRequest $request)
    {
        $form = $request->safe()->only(['role', 'parent_id', 'type']);
        $form['child_id'] = uniqid() . preg_replace("/\s+/", "", $request->role);
        Structure::create($form);
        return redirect(route('structure.index'))->with('message', 'Berhasil tambah jabatan struktural');
    }

    public function show(Structure $structure)
    {
        // return view('attendance.structure.edit')
        //     ->with('structure', $structure)
        //     ->with('parent', Structure::select('id as value', 'role as text')->get());
    }

    public function edit(Structure $structure)
    {
        return view('attendance.structure.edit')
            ->with('structure', $structure)
            ->with('types', Structure::type())
            ->with('parent', Structure::selectOption());
    }

    public function update(UpdateStructureRequest $request, Structure $structure)
    {
        $form = $request->safe()->only(['role', 'parent_id', 'type']);
        $structure->update($form);
        return redirect(route('structure.index'))->with('message', 'Berhasil update jabatan struktural');
    }

    public function destroy(Structure $structure)
    {
        $structure->delete();
        return redirect(route('structure.index'))->with('message', 'Berhasil delete jabatan struktural');
    }

    public function role($child_id)
    {
        return Structure::role($child_id);
    }

    public function parent($child_id)
    {
        return Structure::parent($child_id);
    }

    public function parents($child_id)
    {
        return Structure::parents($child_id);
    }

    public function parentWFlow($child_id)
    {
        return Structure::parentWFlow($child_id);
    }

    public function children($child_id)
    {
        return Structure::children($child_id);
    }

    public function childrens($child_id)
    {
        return Structure::childrens($child_id);
    }

    public function childrenWFlow($child_id)
    {
        return Structure::childrenWFlow($child_id);
    }

    public function parentNChildren($child_id)
    {
        return Structure::parentNChildren($child_id);
    }
    /**
     * 
    public function role(Request $request)
    {
        return Structure::role($request->user()->child_id);
    }

    public function parent(Request $request)
    {
        return Structure::parent($request->user()->child_id);
    }

    public function parents(Request $request)
    {
        return Structure::parents($request->user()->child_id);
    }

    public function parentWFlow(Request $request)
    {
        return Structure::parentWFlow($request->user()->child_id);
    }

    public function children(Request $request)
    {
        return Structure::children($request->user()->child_id);
    }

    public function childrens(Request $request)
    {
        return Structure::childrens($request->user()->child_id);
    }

    public function childrenWFlow(Request $request)
    {
        return Structure::childrenWFlow($request->user()->child_id);
    }

    public function parentNChildren(Request $request)
    {
        return Structure::parentNChildren($request->user()->child_id);
    }
     */
}
