<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class PelaksPengabdian extends Controller
{
    public function pengabdian()
    {
        return Sister::pengabdian(session('id_sdm'));
    }

    public function detailPengabdian($id)
    {
        return Sister::detailPengabdian($id);
    }

    public function bidangIlmuPengabdian($id)
    {
        return Sister::bidangIlmuPengabdian($id);
    }

    public function pengelolJurnal()
    {
        return Sister::pengelolaJurnal(session('id_sdm'));
    }

    public function detailPengelolaJurnal($id)
    {
        return Sister::detailPengelolaJurnal($id);
    }

    public function pembicara()
    {
        return Sister::pembicara(session('id_sdm'));
    }

    public function detailPembicara($id)
    {
        return Sister::detailPembicara($id);
    }

    public function jabatanStruktural()
    {
        return Sister::jabatanStruktural(session('id_sdm'));
    }

    public function detailJabatanStruktural($id)
    {
        return Sister::detailJabatanStruktural($id);
    }
}
