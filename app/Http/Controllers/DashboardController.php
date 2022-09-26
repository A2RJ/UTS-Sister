<?php

namespace App\Http\Controllers;

use App\Models\SDM;
use App\Services\Sister;

class DashboardController extends Controller
{
    public function index()
    {
        return view("SDM.index", [
            "sdm" => SDM::searchSDM()
        ]);
    }

    public function setSession($id_sdm)
    {
        Sister::authorize();
        session(['id_sdm' => $id_sdm]);
        return redirect(route('index'));
    }
}
