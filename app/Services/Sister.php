<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Traits\Sister\Example;
use Illuminate\Support\Arr;

class Sister
{
    use Example;

    function __construct()
    {
    }

    public static function authorize()
    {
        $res = Http::sister()->post("/authorize", [
            "username" => env("SISTER_USERNAME"),
            "password" => env("SISTER_PASSWORD"),
            "id_pengguna" => env("SISTER_ID")
        ]);

        if (Arr::exists($res, 'token')) {
            session(['token' => $res['token']]);
            return response()->json([
                "message" => "Successfully"
            ], 200);
        } else {
            return response()->json([$res->json()], 500);
        }
    }
}
