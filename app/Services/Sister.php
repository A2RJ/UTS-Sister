<?php

namespace App\Services;

use App\Traits\Sister\Kompetensi\Kompetensi;
use App\Traits\Sister\Kualifikasi\Kualifikasi;
use App\Traits\Sister\PelaksPendidikan\PelaksPendidikan;
use App\Traits\Sister\PelaksPenelitian\PelaksPenelitian;
use App\Traits\Sister\PelaksPengabdian\PelaksPengabdian;
use App\Traits\Sister\Penunjang\Penunjang;
use App\Traits\Sister\Profil\Profil;
use App\Traits\Sister\Referensi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

/**
 * The main difference between the Traits and Interfaces in PHP is
 * that the Traits define the actual implementation of each method within each class,
 * so many classes implement the same interface but having different behavior,
 * while traits are just chunks of code injected in a class in PHP.
 * @link:https://www.geeksforgeeks.org/traits-vs-interfaces-in-php/#:~:text=The%20main%20difference%20between%20the,in%20a%20class%20in%20PHP.
 */
class Sister
{
    use Profil,
        Kualifikasi,
        Kompetensi,
        PelaksPendidikan,
        PelaksPenelitian,
        PelaksPengabdian,
        Penunjang,
        Referensi;

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
    }
}
