<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HumanResource;
use App\Http\Requests\HumanResource\StoreHumanResourceRequest;
use App\Http\Requests\HumanResource\UpdateHumanResourceRequest;
use Illuminate\Support\Facades\Hash;

class HumanResourceController extends Controller
{
    public function index()
    {
        $humanResource = HumanResource::all();
        return $this->responseRedirect($humanResource, 'home');
    }

    public function create()
    {
        return view('sister.SDM.create');
    }

    public function store(StoreHumanResourceRequest $request)
    {
        $request->sdm_id = Hash::make($request->sdm_name);
        $form = $request->safe()->only([
            "sdm_name",
            "nidn",
            "nip",
            "active_status_name",
            "employee_status",
            "sdm_type",
            "is_sister_exist",
            "faculty_id",
            "study_program_id",
            "structure_id",
        ]);
        HumanResource::create($form);
        return $this->responseRedirect("$request->sdm_name created");
    }

    public function show(HumanResource $humanResource)
    {
        return view('sister.SDM.show', compact($humanResource));
    }

    public function edit(HumanResource $humanResource)
    {
        return view('sister.SDM.update', compact($humanResource));
    }

    public function update(UpdateHumanResourceRequest $request, HumanResource $humanResource)
    {
        $form = $request->safe()->only([
            "sdm_name",
            "nidn",
            "nip",
            "active_status_name",
            "employee_status",
            "sdm_type",
            "is_sister_exist",
            "faculty_id",
            "study_program_id",
            "structure_id",
        ]);
        $humanResource->update($form);
        return $this->responseRedirect("$request->sdm_name updated");
    }

    public function destroy(HumanResource $humanResource)
    {
        $response = "$humanResource->sdm_name deleted";
        $humanResource->delete();
        return $this->responseRedirect($response);
    }
}
