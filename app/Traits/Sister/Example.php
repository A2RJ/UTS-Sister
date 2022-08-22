<?php

namespace App\Traits\Sister;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait Example
{
    public function index()
    {
        return Http::sister()->get('/1');
    }

    public static function post(Request $request)
    {
        return $request->all();
    }
}
