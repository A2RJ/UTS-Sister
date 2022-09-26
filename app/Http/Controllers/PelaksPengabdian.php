<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class PelaksPengabdian extends Controller
{
    public function pengabdian()
    {
        return view('PelaksPengabdian.Pengabdian.Index', [
            'data' => Sister::pengabdian(session('id_sdm'))
        ]);
    }

    public function detailPengabdian($id)
    {
        return view('PelaksPengabdian.Pengabdian.Id', [
            'data' => Sister::detailPengabdian($id)
        ]);
    }

    public function bidangIlmuPengabdian($id)
    {
        return view('PelaksPengabdian.Pengabdian.BidangIlmu', [
            'data' => Sister::bidangIlmuPengabdian($id)
        ]);
    }

    public function pengelolJurnal()
    {
        return view('PelaksPengabdian.PengelolaJurnal.Index', [
            'data' => Sister::pengelolaJurnal(session('id_sdm'))
        ]);
    }

    public function detailPengelolaJurnal($id)
    {
        return view('PelaksPengabdian.PengelolaJurnal.Id', [
            'data' => Sister::detailPengelolaJurnal($id)
        ]);
    }

    public function pembicara()
    {
        return view('PelaksPengabdian.Pembicara.Index', [
            'data' => Sister::pembicara(session('id_sdm'))
        ]);
    }

    public function detailPembicara($id)
    {
        return view('PelaksPengabdian.Pembicara.Id', [
            'data' => Sister::detailPembicara($id)
        ]);
    }

    public function jabatanStruktural()
    {
        return view('PelaksPengabdian.JabatanStruktural.Index', [
            'data' => Sister::jabatanStruktural(session('id_sdm'))
        ]);
    }

    public function detailJabatanStruktural($id)
    {
        return view('PelaksPengabdian.JabatanStruktural.Id', [
            'data' => Sister::detailJabatanStruktural($id)
        ]);
    }
}
