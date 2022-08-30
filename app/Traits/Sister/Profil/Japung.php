<?php

namespace App\Traits\Sister\Profil;

use Illuminate\Support\Facades\Http;

trait Japung
{
    static public function japung($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/jabatan_fungsional?id_sdm=$id_sdm");
    }

    static public function detailJapung($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/jabatan_fungsional/$id");
    }

    static public function ajuanJapung($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/jabatan_fungsional/ajuan?id_sdm=$id_sdm");
    }

    static public function detailAjuanJapung($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/jabatan_fungsional/ajuan/$id");
    }
}
