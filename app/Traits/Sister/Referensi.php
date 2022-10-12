<?php

namespace App\Traits\Sister;

use Illuminate\Support\Facades\Http;
use Rap2hpoutre\FastExcel\FastExcel;

trait Referensi
{
    static public function agama()
    {
        return Http::referensi()->get("/agama");
    }

    static public function bidang_studi()
    {
        return Http::referensi()->get("/bidang_studi");
    }

    static public function listDokumen($id_sdm)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/dokumen?id_sdm=$id_sdm");
    }

    static public function detailDokumen($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/dokumen/$id");
    }

    static public function downladDokumen($id)
    {
        return Http::withToken(session("token"))->get(env("SISTER_URL") . "/dokumen/$id/download");
    }

    static public function sdm()
    {
        $res = Http::referensi()->get("/sdm?nama=widi");
        return $res;
        // var_dump($res->json());
        // (new FastExcel($res->json()))->export("List_sdm.xlsx");
    }
}
