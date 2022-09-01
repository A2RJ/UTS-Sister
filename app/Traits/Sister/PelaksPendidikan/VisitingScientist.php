<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait VisitingScientist
{
    static public function visitingScientist($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/visiting_scientist?id_sdm=$id_sdm");
    }

    static public function detailVisitingScientist($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/visiting_scientist/$id");
    }
}
