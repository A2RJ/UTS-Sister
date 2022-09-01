<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait TugasTambahan
{
    static public function tugasTambahan($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/tugas_tambahan?id_sdm=$id_sdm");
    }

    static public function detailTugasTambahan($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/tugas_tambahan/$id");
    }
}
