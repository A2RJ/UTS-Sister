<?php

namespace App\Http\Controllers;

use App\Services\Sister;

class ProfilController extends Controller
{
    public function dataPribadi()
    {
        return "dataPribadi";
        // return Sister::dataPribadi(session('id_sdm'));
    }

    public function inpassing()
    {
        return "inpassing";
        // return Sister::inpassing(session('id_sdm'));
    }

    public function jabatanFungsional()
    {
        return "jabatanFungsional";
        // return Sister::japung(session('id_sdm'));
    }

    public function detailJabatanFungsional($id)
    {
        return "detailJabatanFungsional";
        // return Sister::detailJapung($id);
    }

    public function ajuanJabatanFungsional()
    {
        return "ajuanJabatanFungsional";
        // return Sister::ajuanJapung(session('id_sdm'));
    }

    public function detailAjuanJabatanFungsional($id)
    {
        return "detailAjuanJabatanFungsional";
        // return Sister::detailAjuanJapung($id);
    }

    public function kepangkatan()
    {
        return "kepangkatan";
        // return Sister::kepangkatan(session('id_sdm'));
    }

    public function detailKepangkatan($id)
    {
        return "detailKepangkatan";
        // return Sister::detailKepangkatan($id);
    }

    public function penempatan()
    {
        return "penempatan";
        // return Sister::penugasan(session('id_sdm'));
    }

    public function detailPenempatan($id)
    {
        return "detailPenempatan";
        // return Sister::detailPenugasan($id);
    }
}
