<?php

namespace App\Traits\Sister\Kompetensi;

use Illuminate\Support\Facades\Http;

trait SertifikasiDosen
{
    static public function sertifikasiDosen($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/sertifikasi_dosen?id_sdm=$id_sdm");
    }

    static public function detailSertifikasiDosen($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/sertifikasi_dosen/$id");
    }
}
