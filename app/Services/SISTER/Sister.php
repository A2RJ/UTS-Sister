<?php

namespace App\Services\SISTER;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Traits\Sister\Example;

class Sister
{
    use Example;

    function __construct()
    {
        // $this->checkToken();
    }

    public function checkToken()
    {
        if (!Session::has('token')) {
            $res = Http::post(env('SISTER_URL') . "/token", [
                'username' => env('SISTER_USERNAME'),
                'password' => env('SISTER_PASSWORD')
            ]);
            $token = $res->json()['token'];
            Session::put('token', $token);
        }
    }

    public function isValidRequest($response)
    {
        if ($response->successful()) { // Determine if the status code is >= 200 and < 300...
            return $response->json();
        } else if ($response->failed()) { // Determine if the status code is >= 400...
            return $response->json();
        } else if ($response->clientError()) { // Determine if the response has a 400 level status code...
            return $response->json();
        } else if ($response->serverError()) { // Determine if the response has a 500 level status code...
            return $response->json();
        }
    }
}
