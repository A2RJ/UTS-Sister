<?php

namespace App\Traits\Sister\Kualifikasi;

use Illuminate\Support\Facades\Http;

trait Diklat
{
    static public function diklat($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/diklat?id_sdm=$id_sdm");
    }

    static public function detailDiklat($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/diklat/$id_sdm");
    }
}
