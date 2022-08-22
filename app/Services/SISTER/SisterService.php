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
            $this->getToken();
        }
    }

    public function getToken()
    {
        $res = Http::post(env('SISTER_URL') . "/token", [
            'username' => env('SISTER_USERNAME'),
            'password' => env('SISTER_PASSWORD')
        ]);
        $token = $res->json()['token'];
        Session::put('token', $token);
    }

    public function sister()
    {
        return Http::withHeaders([
            'token' => Session::get('token')
        ])->baseUrl(env('SISTER_URL'));
    }

    public function index()
    {
        return $this->sister()->get('/');
    }
}
