<?php

namespace App\Http\Controllers;

use App\Models\SDM;

class DashboardController extends Controller
{
    public function index()
    {
        return view("SDM.index", [
            "sdm" => SDM::searchSDM()
        ]);
    }
}
