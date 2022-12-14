<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StructuralPosition\StoreStructuralPositionRequest;
use App\Http\Requests\StructuralPosition\UpdateStructuralPositionRequest;
use App\Models\StructuralPosition;
use App\Models\HumanResource;
use App\Models\Structure;

class StructuralPositionController extends Controller
{
    public function create()
    {
        return view('admin.structure.assign.create')
            ->with('human_resources', HumanResource::selectOption())
            ->with('structurals', Structure::selectOptionStructure());
    }

    public function store(StoreStructuralPositionRequest $request)
    {
        $form = $request->safe()->only(['sdm_id', 'structure_id']);
        StructuralPosition::create($form);
        return redirect(route('structure.index'))->with('message', 'Berhasil assign jabatan struktural');
    }

    public function edit(StructuralPosition $structuralPosition)
    {
        //
    }

    public function update(UpdateStructuralPositionRequest $request, StructuralPosition $structuralPosition)
    {
        //
    }

    public function destroy(StructuralPosition $structuralPosition)
    {
        //
    }
}
