<?php

namespace App\Http\Controllers;

use App\Services\Sister;

class ReferensiController extends Controller
{
    public function referensi($referensi)
    {
        return Sister::$referensi();
    }
}
