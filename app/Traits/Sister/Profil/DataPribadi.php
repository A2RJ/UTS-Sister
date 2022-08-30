<?php

namespace App\Traits\Sister\Profil;

use App\Traits\Sister\Profil\Inpassing;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

trait DataPribadi
{
    use Inpassing;
    static public function ajuan($id_sdm)
    {
        return Http::dataPribadi()->get("/ajuan?id_sdm=$id_sdm");
    }

    static public function ajuanDetail($id_ajuan)
    {
        return Http::dataPribadi()->get("/ajuan/$id_ajuan");
    }

    static public function bidangIlmu($id_sdm)
    {
        return Http::dataPribadi()->get("/bidang_ilmu/$id_sdm");
    }

    static public function alamat($id_sdm)
    {
        return Http::dataPribadi()->get("/alamat/$id_sdm");
    }

    static public function foto($id_sdm)
    {
        return Http::dataPribadi()->get("/foto/$id_sdm");
    }

    static public function keluarga($id_sdm)
    {
        return Http::dataPribadi()->get("/keluarga/$id_sdm");
    }

    static public function kepegawaian($id_sdm)
    {
        return Http::dataPribadi()->get("/kepegawaian/$id_sdm");
    }

    static public function kependudukan($id_sdm)
    {
        return Http::dataPribadi()->get("/kependudukan/$id_sdm");
    }

    static public function lain($id_sdm)
    {
        return Http::dataPribadi()->get("/lain/$id_sdm");
    }
    static public function profil($id_sdm)
    {
        return Http::dataPribadi()->get("/profil/$id_sdm");
    }

    static public function dataPribadi($id_sdm)
    {
        $res = Http::pool(fn (Pool $pool) => [
            $pool->dataPribadi()->get("/profil/$id_sdm"),
            $pool->dataPribadi()->get("/kependudukan/$id_sdm"),
            $pool->dataPribadi()->get("/keluarga/$id_sdm"),
            $pool->dataPribadi()->get("/bidang_ilmu/$id_sdm"),
            $pool->dataPribadi()->get("/alamat/$id_sdm"),
            $pool->dataPribadi()->get("/kepegawaian/$id_sdm"),
            $pool->dataPribadi()->get("/lain/$id_sdm")
        ]);

        return response()->pool($res);
    }
}
