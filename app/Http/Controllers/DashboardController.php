<?php

namespace App\Http\Controllers;

use App\Models\SDM;
use App\Services\Sister;

class DashboardController extends Controller
{
    public function index()
    {
        Sister::authorize();
        return view("SDM.index", [
            "sdm" => SDM::searchSDM()
        ]);
    }

    public function setSession($id_sdm, $nama_sdm)
    {
        Sister::authorize();
        session(['id_sdm' => $id_sdm, 'nama_sdm' => $nama_sdm]);
        return redirect(route('index'));
    }
}
