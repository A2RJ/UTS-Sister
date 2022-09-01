<?php

namespace App\Traits\Sister\PelaksPenelitian;

use Illuminate\Support\Facades\Http;

trait PatenHKI
{
    static public function patenHKI($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/kekayaan_intelektual?id_sdm=$id_sdm");
    }

    static public function detailPatenHKI($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/kekayaan_intelektual/$id");
    }

    static public function bidangIlmuPatenHKI($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/kekayaan_intelektual/$id/bidang_ilmu");
    }
}
