<?php

namespace App\Traits\Sister\Profil;

use Illuminate\Support\Facades\Http;

trait Inpassing
{
    static public function inpassing($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/inpassing?id_sdm=$id_sdm");
    }
}
