<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait BahanAjar
{
    static public function bahanAjar($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/bahan_ajar?id_sdm=$id_sdm");
    }

    static public function detailBahanAjar($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/bahan_ajar/$id");
    }
}
