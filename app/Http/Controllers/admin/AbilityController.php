<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use App\Http\Requests\Ability\StoreAbilityRequest;
use App\Http\Requests\Ability\UpdateAbilityRequest;

class AbilityController extends Controller
{
    public function index()
    {
        return response([
            "isAPI" => $this->isApi
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreAbilityRequest $request)
    {
        //
    }

    public function show(Ability $ability)
    {
        //
    }

    public function edit(Ability $ability)
    {
        //
    }

    public function update(UpdateAbilityRequest $request, Ability $ability)
    {
        //
    }

    public function destroy(Ability $ability)
    {
        //
    }
}
