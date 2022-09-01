<?php

namespace App\Traits\Sister\PelaksPendidikan;

use Illuminate\Support\Facades\Http;

trait BimbinganMhs
{
    static public function bimbinganMhs($id_sdm, $id_semester = "")
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/bimbingan_mahasiswa?id_sdm=$id_sdm&id_semester=$id_semester");
    }

    static public function detailBimbinganMhs($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/bimbingan_mahasiswa/$id");
    }

    static public function bidangIlmuBimbinganMhs($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/bimbingan_mahasiswa/$id/bidang_ilmu");
    }
}
