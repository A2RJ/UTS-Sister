<?php

namespace App\Traits\Sister\Kompetensi;

use Illuminate\Support\Facades\Http;

trait Tes
{
    static public function nilaiTes($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/nilai_tes?id_sdm=$id_sdm");
    }

    static public function detailNilaiTes($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/nilai_tes/$id");
    }

    static public function ajuanNilaiTes($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/nilai_tes/ajuan?id_sdm=$id_sdm");
    }

    static public function detailAjuanNilaiTes($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/nilai_tes/ajuan/$id");
    }
}
