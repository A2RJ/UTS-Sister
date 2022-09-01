<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait PengujianMhs
{
    static public function pengujianMhs($id_sdm, $id_semester = "")
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengujian_mahasiswa?id_sdm=$id_sdm&id_semester=$id_semester");
    }

    static public function detailPengujianMhs($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengujian_mahasiswa/$id");
    }

    static public function bidangIlmuPengujianMhs($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/pengujian_mahasiswa/$id/bidang_ilmu");
    }
}
