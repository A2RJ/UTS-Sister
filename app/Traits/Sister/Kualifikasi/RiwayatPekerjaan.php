<?php

namespace App\Traits\Sister\Kualifikasi;

use Illuminate\Support\Facades\Http;

trait RiwayatPekerjaan
{
    static public function riwayat_pekerjaan($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/riwayat_pekerjaan?id_sdm=$id_sdm");
    }

    static public function detailRiwayatPekerjaan($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/riwayat_pekerjaan/$id_sdm");
    }
}
