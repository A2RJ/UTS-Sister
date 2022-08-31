<?php

namespace App\Traits\Sister\Kualifikasi;

use Illuminate\Support\Facades\Http;

trait PendidikanFormal
{
    static public function pendidikanFormal($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pendidikan_formal?id_sdm=$id_sdm");
    }

    static public function detailPendidikanFormal($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pendidikan_formal/$id");
    }

    static public function ajuanPendidikanFormal($id_sdm)

    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pendidikan_formal/ajuan?id_sdm=$id_sdm");
    }

    static public function detailAjuanPendidikanFormal($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pendidikan_formal/ajuan/$id");
    }
}
