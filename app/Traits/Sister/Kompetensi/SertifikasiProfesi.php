<?php

namespace App\Traits\Sister\Kompetensi;

use Illuminate\Support\Facades\Http;

trait SertifikasiProfesi
{
    static public function sertifikasiProfesi($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/sertifikasi_profesi?id_sdm=$id_sdm");
    }

    static public function detailSertifikasiProfesi($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/sertifikasi_profesi/$id");
    }
}
