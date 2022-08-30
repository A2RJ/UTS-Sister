<?php

namespace App\Traits\Sister\Profil;

use Illuminate\Support\Facades\Http;

trait Penugasan
{
    static public function penugasan($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penugasan?id_sdm=$id_sdm");
    }

    static public function detailPenugasan($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/penugasan/$id");
    }
}
