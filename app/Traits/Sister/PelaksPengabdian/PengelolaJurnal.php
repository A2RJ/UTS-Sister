<?php

namespace App\Traits\Sister\PelaksPengabdian;

use Illuminate\Support\Facades\Http;

trait PengelolaJurnal
{
    static public function pengelolaJurnal($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengelola_jurnal?id_sdm=$id_sdm");
    }

    static public function detailPengelolaJurnal($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengelola_jurnal/$id");
    }
}
