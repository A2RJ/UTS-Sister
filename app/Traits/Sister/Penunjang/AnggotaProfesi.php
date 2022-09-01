<?php

namespace App\Traits\Sister\Penunjang;

use Illuminate\Support\Facades\Http;

trait AnggotaProfesi
{
    static public function anggotaProfesi($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/anggota_profesi?id_sdm=$id_sdm");
    }

    static public function detailAnggotaProfesi($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/anggota_profesi/$id");
    }
}
