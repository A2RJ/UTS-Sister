<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class PelaksPenelitian extends Controller
{
    public function penelitian()
    {
        return Sister::penelitian(session('id_sdm'));
    }

    public function detailPeneltian($id)
    {
        return Sister::detailPenelitian($id);
    }

    public function bidangIlmuPenelitian($id)
    {
        return Sister::bidangIlmuPenelitian($id);
    }

    public function publikasiKarya()
    {
        return Sister::publikasiKarya(session('id_sdm'));
    }

    public function detailPublikasiKarya($id)
    {
        return Sister::detailPublikasiKarya($id);
    }

    public function bidangIlmuPublikasiKarya($id)
    {
        return Sister::bidangIlmuPublikasiKarya($id);
    }

    public function patenHKI()
    {
        return Sister::patenHKI(session('id_sdm'));
    }

    public function detailPatenHKI($id)
    {
        return Sister::detailPatenHKI($id);
    }

    public function bidangIlmuPatenHKI($id)
    {
        return Sister::bidangIlmuPatenHKI($id);
    }
}
