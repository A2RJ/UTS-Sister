<?php

namespace App\Http\Controllers\BKD;

use App\Http\Controllers\Controller;
use App\Services\Sister;

class PenunjangController extends Controller
{
    public function anggotaProfesi()
    {
        return view('BKD.Penunjang.AnggotaProfresi.Index', [
            'data' => json_decode(Sister::anggotaProfesi(session('id_sdm')), true)
        ]);
    }

    public function detailAnggotaProfesi($id)
    {
        return view('BKD.Penunjang.AnggotaProfresi.Id', [
            'data' => json_decode(Sister::detailAnggotaProfesi($id), true)
        ]);
    }

    public function penghargaan()
    {
        return view('BKD.Penunjang.Penghargaan.Index', [
            'data' => json_decode(Sister::penghargaan(session('id_sdm')), true)
        ]);
    }

    public function detailPenghargaan($id)
    {
        return view('BKD.Penunjang.Penghargaan.Id', [
            'data' => json_decode(Sister::detailPenghargaan($id), true)
        ]);
    }

    public function penunjangLain()
    {
        return view('BKD.Penunjang.PenunjangLain.Index', [
            'data' => json_decode(Sister::penunjangLain(session('id_sdm')), true)
        ]);
    }

    public function detailPenunjangLain($id)
    {
        return view('BKD.Penunjang.PenunjangLain.Id', [
            'data' => json_decode(Sister::detailPenunjangLain($id), true)
        ]);
    }
}
