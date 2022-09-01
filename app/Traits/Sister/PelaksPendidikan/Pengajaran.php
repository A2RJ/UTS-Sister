<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait Pengajaran
{
    static public function pegajaran($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengajaran?id_sdm=$id_sdm");
    }

    static public function detailPengajaran($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengajaran/$id");
    }

    static public function bidangIlmuPengajaran($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengajaran/$id/bidang_ilmu");
    }
}
