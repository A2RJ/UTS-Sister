<?php

namespace App\Http\Controllers\BKD;

use App\Http\Controllers\Controller;
use App\Services\Sister;

class PelaksPenelitian extends Controller
{
    public function penelitian()
    {
        return view('PelaksPenelitian.Penelitian.Index', [
            'data' => json_decode(Sister::penelitian(session('id_sdm')), true)
        ]);
    }

    public function detailPenelitian($id)
    {
        return view('PelaksPenelitian.Penelitian.Id', [
            'data' => json_decode(Sister::detailPenelitian($id), true)
        ]);
    }

    public function bidangIlmuPenelitian($id)
    {
        return view('PelaksPenelitian.Penelitian.BidangIlmu', [
            'data' => json_decode(Sister::bidangIlmuPenelitian($id), true)
        ]);
    }

    public function publikasiKarya()
    {
        return view('PelaksPenelitian.PublikasiKarya.Index', [
            'data' => json_decode(Sister::publikasiKarya(session('id_sdm')), true)
        ]);
    }

    public function detailPublikasiKarya($id)
    {
        return view('PelaksPenelitian.PublikasiKarya.Id', [
            'data' => json_decode(Sister::detailPublikasiKarya($id), true)
        ]);
    }

    public function bidangIlmuPublikasiKarya($id)
    {
        return view('PelaksPenelitian.PublikasiKarya.BidangIlmu', [
            'data' => json_decode(Sister::bidangIlmuPublikasiKarya($id), true)
        ]);
    }

    public function patenHKI()
    {
        return view('PelaksPenelitian.PatenHKI.Index', [
            'data' => json_decode(Sister::patenHKI(session('id_sdm')), true)
        ]);
    }

    public function detailPatenHKI($id)
    {
        return view('PelaksPenelitian.PatenHKI.Id', [
            'data' => json_decode(Sister::detailPatenHKI($id), true)
        ]);
    }

    public function bidangIlmuPatenHKI($id)
    {
        return view('PelaksPenelitian.PatenHKI.BidangIlmu', [
            'data' => json_decode(Sister::bidangIlmuPatenHKI($id), true)
        ]);
    }
}
