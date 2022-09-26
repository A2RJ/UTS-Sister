<?php

namespace App\Http\Controllers;

use App\Services\Sister;

class PenunjangController extends Controller
{
    public function anggotaProfesi()
    {
        return view('Penunjang.AnggotaProfresi.Index', [
            'data' => Sister::anggotaProfesi(session('id_sdm'))
        ]);
    }

    public function detailAnggotaProfesi($id)
    {
        return view('Penunjang.AnggotaProfresi.Id', [
            'data' => Sister::detailAnggotaProfesi($id)
        ]);
    }

    public function penghargaan()
    {
        return view('Penunjang.Penghargaan.Index', [
            'data' => Sister::penghargaan(session('id_sdm'))
        ]);
    }

    public function detailPenghargaan($id)
    {
        return view('Penunjang.Penghargaan.Id', [
            'data' => Sister::detailPenghargaan($id)
        ]);
    }

    public function penunjangLain()
    {
        return view('Penunjang.PenunjangLain.Index', [
            'data' => Sister::penunjangLain(session('id_sdm'))
        ]);
    }

    public function detailPenunjangLain($id)
    {
        return view('Penunjang.PenunjangLain.Id', [
            'data' => Sister::detailPenunjangLain($id)
        ]);
    }
}
