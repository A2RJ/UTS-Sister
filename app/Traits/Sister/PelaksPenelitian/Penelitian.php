<?php

namespace App\Traits\Sister\PelaksPenelitian;

use Illuminate\Support\Facades\Http;

trait Penelitian
{
    static public function penelitian($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penelitian?id_sdm=$id_sdm");
    }

    static public function detailPenelitian($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penelitian/$id");
    }

    static public function bidangIlmuPenelitian($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penelitian/$id/bidang_ilmu");
    }
}
