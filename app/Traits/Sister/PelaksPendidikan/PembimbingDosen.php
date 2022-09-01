<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait PembimbingDosen
{
    /**
     * List data pembimbingan dosen
     * @param mixed $id_sdm
     * @return [type]
     */
    static public function pembimbingDosen($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/bimbing_dosen?id_sdm=$id_sdm");
    }

    static public function detailPembimbingDosen($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/bimbing_dosen/$id");
    }
}
