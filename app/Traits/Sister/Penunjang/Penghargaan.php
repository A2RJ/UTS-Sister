<?php

namespace App\Traits\Sister\Penunjang;

use Illuminate\Support\Facades\Http;

trait Penghargaan
{
    static public function penghargaan($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penghargaan?id_sdm=$id_sdm");
    }

    static public function detailPenghargaan($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penghargaan/$id");
    }
}
