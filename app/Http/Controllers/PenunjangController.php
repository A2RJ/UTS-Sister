<?php

namespace App\Http\Controllers;

use App\Services\Sister;

class PenunjangController extends Controller
{
    public function anggotaProfesi()
    {
        return Sister::anggotaProfesi(session('id_sdm'));
    }

    public function detailAnggotaProfesi($id)
    {
        return Sister::detailAnggotaProfesi($id);
    }

    public function penghargaan()
    {
        return Sister::penghargaan(session('id_sdm'));
    }

    public function detailPenghargaan($id)
    {
        return Sister::detailPenghargaan($id);
    }

    public function penunjangLain()
    {
        return Sister::penunjangLain(session('id_sdm'));
    }

    public function detailPenunjangLain($id)
    {
        return Sister::detailPenunjangLain($id);
    }
}
