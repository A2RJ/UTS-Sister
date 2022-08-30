<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Traits\Sister\Referensi;
use Illuminate\Support\Arr;

class Sister
{
    use Referensi;

    public static function authorize()
    {
        $res = Http::sister()->post("/authorize", [
            "username" => env("SISTER_USERNAME"),
            "password" => env("SISTER_PASSWORD"),
            "id_pengguna" => env("SISTER_ID"),
            "role" => "Sister-WS Basic"
        ]);

        if (Arr::exists($res, 'token')) {
            session(['token' => $res['token']]);
            return response()->json([
                "message" => "Successfully",
                "token" => session("token")
            ], 200);
        } else {
            return response()->json([$res->json()], 500);
        }
        echo "Berhasil";
    }
}
