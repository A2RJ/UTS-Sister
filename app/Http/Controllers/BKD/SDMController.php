<?php

namespace App\Http\Controllers\BKD;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResource\StoreHumanResourceRequest;
use App\Http\Requests\HumanResource\UpdateHumanResourceRequest;
use App\Models\HumanResource;
use App\Services\Sister;

class SDMController extends Controller
{
    public function index()
    {
        return view("SDM.index", [
            "sdm" => HumanResource::searchSDM()
        ]);
    }

    public function setSession($sdm_id, $sdm_name)
    {
        Sister::authorize();
        session(['sdm_id' => $sdm_id, 'sdm_name' => $sdm_name]);
        return back();
    }
}
