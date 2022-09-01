<?php

namespace App\Traits\Sister\PelaksPengabdian;

use Illuminate\Support\Facades\Http;

trait JabatanStruktural
{
    static public function jabatanStruktural($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/jabatan_struktural?id_sdm=$id_sdm");
    }

    static public function detailJabatanStruktural($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/jabatan_struktural/$id");
    }
}
