<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class PelaksPenelitian extends Controller
{
    public function penelitian()
    {
        return view('PelaksPenelitian.Penelitian.Index', [
            // 'data' => Sister::penelitian(session('id_sdm'))
        ]);
    }

    public function detailPeneltian($id)
    {
        return view('PelaksPenelitian.Penelitian.Id', [
            // 'data' => Sister::detailPenelitian($id)
        ]);
    }

    public function bidangIlmuPenelitian($id)
    {
        return view('PelaksPenelitian.Penelitian.BidangIlmu', [
            // 'data' => Sister::bidangIlmuPenelitian($id)
        ]);
    }

    public function publikasiKarya()
    {
        return view('PelaksPenelitian.PublikasiKarya.Index', [
            // 'data' => Sister::publikasiKarya(session('id_sdm'))
        ]);
    }

    public function detailPublikasiKarya($id)
    {
        return view('PelaksPenelitian.PublikasiKarya.Id', [
            // 'data' => Sister::detailPublikasiKarya($id)
        ]);
    }

    public function bidangIlmuPublikasiKarya($id)
    {
        return view('PelaksPenelitian.PublikasiKarya.BidangIlmu', [
            // 'data' => Sister::bidangIlmuPublikasiKarya($id)
        ]);
    }

    public function patenHKI()
    {
        return view('PelaksPenelitian.PatenHKI.Index', [
            // 'data' => Sister::patenHKI(session('id_sdm'))
        ]);
    }

    public function detailPatenHKI($id)
    {
        return view('PelaksPenelitian.PatenHKI.Id', [
            // 'data' => Sister::detailPatenHKI($id)
        ]);
    }

    public function bidangIlmuPatenHKI($id)
    {
        return view('PelaksPenelitian.PatenHKI.BidangIlmu', [
            // 'data' => Sister::bidangIlmuPatenHKI($id)
        ]);
    }
}
