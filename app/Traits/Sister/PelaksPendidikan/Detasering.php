<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait Detasering
{
    static public function detasering($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/detasering?id_sdm=$id_sdm");
    }

    static public function detailDetasering($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/detasering/$id");
    }
}
