<?php

namespace App\Traits\Sister\PelaksPenelitian;

use Illuminate\Support\Facades\Http;

trait PublikasiKarya
{
    static public function publikasiKarya($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/publikasi?id_sdm=$id_sdm");
    }

    static public function detailPublikasiKarya($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/publikasi/$id");
    }

    static public function bidangIlmuPublikasiKarya($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/publikasi/$id/bidang_ilmu");
    }
}
