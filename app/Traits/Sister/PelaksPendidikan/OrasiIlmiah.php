<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait OrasiIlmiah
{
    static public function orasiIlmiah($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/orasi_ilmiah?id_sdm=$id_sdm");
    }

    static public function detailOrasiIlmiah($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/orasi_ilmiah/$id");
    }
}
