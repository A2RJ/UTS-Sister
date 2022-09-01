<?php

namespace App\Traits\Sister\PelaksPengabdian;

use Illuminate\Support\Facades\Http;

trait Pembicara
{
    static public function pembicara($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pembicara?id_sdm=$id_sdm");
    }

    static public function detailPembicara($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pembicara/$id");
    }
}
