<?php

namespace App\Http\Controllers\BKD;

use App\Http\Controllers\Controller;
use App\Services\Sister;
use Illuminate\Http\Request;

class PelaksPengabdian extends Controller
{
    public function pengabdian()
    {
        return view('PelaksPengabdian.Pengabdian.Index', [
            'data' => json_decode(Sister::pengabdian(session('id_sdm')), true)
        ]);
    }

    public function detailPengabdian($id)
    {
        return view('PelaksPengabdian.Pengabdian.Id', [
            'data' => json_decode(Sister::detailPengabdian($id), true)
        ]);
    }

    public function bidangIlmuPengabdian($id)
    {
        return view('PelaksPengabdian.Pengabdian.BidangIlmu', [
            'data' => json_decode(Sister::bidangIlmuPengabdian($id), true)
        ]);
    }

    public function pengelolaJurnal()
    {
        return view('PelaksPengabdian.PengelolaJurnal.Index', [
            'data' => json_decode(Sister::pengelolaJurnal(session('id_sdm')), true)
        ]);
    }

    public function detailPengelolaJurnal($id)
    {
        return view('PelaksPengabdian.PengelolaJurnal.Id', [
            'data' => json_decode(Sister::detailPengelolaJurnal($id), true)
        ]);
    }

    public function pembicara()
    {
        return view('PelaksPengabdian.Pembicara.Index', [
            'data' => json_decode(Sister::pembicara(session('id_sdm')), true)
        ]);
    }

    public function detailPembicara($id)
    {
        return view('PelaksPengabdian.Pembicara.Id', [
            'data' => json_decode(Sister::detailPembicara($id), true)
        ]);
    }

    public function jabatanStruktural()
    {
        return view('PelaksPengabdian.JabatanStruktural.Index', [
            'data' => json_decode(Sister::jabatanStruktural(session('id_sdm')), true)
        ]);
    }

    public function detailJabatanStruktural($id)
    {
        return view('PelaksPengabdian.JabatanStruktural.Id', [
            'data' => json_decode(Sister::detailJabatanStruktural($id), true)
        ]);
    }
}
