<?php

namespace App\Traits\Sister\Profil;

use Illuminate\Support\Facades\Http;

trait Kepangkatan
{
    static public function kepangkatan($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/kepangkatan?id_sdm=$id_sdm");
    }

    static public function detailKepangkatan($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/kepangkatan/$id");
    }
}
