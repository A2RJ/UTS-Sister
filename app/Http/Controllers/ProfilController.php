<?php

namespace App\Http\Controllers;

use App\Services\Sister;

class ProfilController extends Controller
{
    public function dataPribadi()
    {
        return view('Profil.Index', [
            'data' => Sister::dataPribadi(session('id_sdm'))
        ]);
    }

    public function inpassing()
    {
        return view('Profil.Inpassing', [
            'data' => Sister::inpassing(session('id_sdm'))
        ]);
    }

    public function jabatanFungsional()
    {
        return view('Profil.JabatanFungsional.Index', [
            'data' => Sister::japung(session('id_sdm'))
        ]);
    }

    public function detailJabatanFungsional($id)
    {
        return view('Profil.JabatanFungsional.Id', [
            'data' => Sister::detailJapung($id)
        ]);
    }

    public function ajuanJabatanFungsional()
    {
        return view('Profil.JabatanFungsional.Ajuan.Index', [
            'data' => Sister::ajuanJapung(session('id_sdm'))
        ]);
    }

    public function detailAjuanJabatanFungsional($id)
    {
        return view('Profil.JabatanFungsional.Ajuan.Id', [
            'data' => Sister::detailAjuanJapung($id)
        ]);
    }

    public function kepangkatan()
    {
        return view('Profil.Kepangkatan.Index', [
            'data' => Sister::kepangkatan(session('id_sdm'))
        ]);
    }

    public function detailKepangkatan($id)
    {
        return view('Profil.Kepangkatan.Id', [
            'data' => Sister::detailKepangkatan($id)
        ]);
    }

    public function penempatan()
    {
        return view('Profil.Penempatan.Index', [
            'data' => Sister::penugasan(session('id_sdm'))
        ]);
    }

    public function detailPenempatan($id)
    {
        return view('Profil.Penempatan.Id', [
            'data' => Sister::detailPenugasan($id)
        ]);
    }
}
