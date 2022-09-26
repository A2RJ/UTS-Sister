<?php

namespace App\Traits\Sister\Kompetensi;

use Illuminate\Support\Facades\Http;

trait Tes
{
    static public function tes($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/nilai_tes?id_sdm=$id_sdm");
    }

    static public function detailTes($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/nilai_tes/$id");
    }

    static public function ajuanTes($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/nilai_tes/ajuan?id_sdm=$id_sdm");
    }

    static public function detailAjuanTes($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/nilai_tes/ajuan/$id");
    }
}
