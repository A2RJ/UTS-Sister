<?php

namespace App\Services\SISTER;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SisterService
{
    function __construct()
    {
        // $this->checkToken();
    }

    public function checkToken()
    {
        if (!Session::has('token')) {
            $res = Http::post(env('SISTER_URL') . "/token", [
                'username' => env('SISTER_USERNAME'),
                'password' => env('SISTER_PAS   SWORD')
            ]);
            $token = $res->json()['token'];
            Session::put('token', $token);
        }
    }

    public function index()
    {
        try {
            Http::sister()->get('/');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
