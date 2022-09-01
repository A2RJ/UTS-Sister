<?php

namespace App\Traits\Sister\PelaksPengabdian;

use Illuminate\Support\Facades\Http;

trait Pengabdian
{
    static public function pengabdian($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengabdian?id_sdm=$id_sdm");
    }

    static public function detailPengabdian($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengabdian/$id");
    }

    static public function bidangIlmuPengabdian($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengabdian/$id/bidang_ilmu");
    }
}
