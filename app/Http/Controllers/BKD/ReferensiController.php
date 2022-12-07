<?php

namespace App\Http\Controllers\BKD;

use App\Http\Controllers\Controller;
use App\Services\Sister;

class ReferensiController extends Controller
{
    public function referensi($referensi, $params = false)
    {
        return Sister::$referensi($params);
    }
}
