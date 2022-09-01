<?php

namespace App\Traits\Sister\Penunjang;

use Illuminate\Support\Facades\Http;

trait PenunjangLain
{
    static public function penunjangLain($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penunjang_lain?id_sdm=$id_sdm");
    }

    static public function detailPenunjangLain($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penunjang_lain/$id");
    }
}
