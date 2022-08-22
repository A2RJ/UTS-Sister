<?php

namespace App\Services\SISTER;

use Illuminate\Support\Facades\Http;

class ExampleSisterService extends SisterService
{
    public function index()
    {
        return Http::sister()->get('/');
    }
}
