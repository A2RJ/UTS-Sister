<?php

namespace App\Http\Controllers;

use App\Services\Sister;

class ProfilController extends Controller
{
    public function dataPribadi()
    {
        $response = Sister::dataPribadi(session('id_sdm'));
        $penugasan = Sister::penugasan(session('id_sdm'))[0];
        $kepegawaian = array_merge($response['kepegawaian'], $penugasan);

        return view('Profil.Index', [
            'profil' => $response['profil'],
            'kependudukan' => $response['kependudukan'],
            'keluarga' => $response['keluarga'],
            'bidang_ilmu' => $response['bidang_ilmu'],
            'alamat' => $response['alamat'],
            'kepegawaian' => $kepegawaian,
            'lain' => $response['lain'],
        ]);
    }

    public function inpassing()
    {
        return view('Profil.Inpassing', [
            'data' => json_decode(Sister::inpassing(session('id_sdm')), true)
        ]);
    }

    public function jabatanFungsional()
    {
        return view('Profil.JabatanFungsional.Index', [
            'data' => json_decode(Sister::japung(session('id_sdm')), true)
        ]);
    }

    public function detailJabatanFungsional($id)
    {
        return view('Profil.JabatanFungsional.Id', [
            'data' => json_decode(Sister::detailJapung($id), true)
        ]);
    }

    public function ajuanJabatanFungsional()
    {
        return view('Profil.JabatanFungsional.Ajuan.Index', [
            'data' => json_decode(Sister::ajuanJapung(session('id_sdm')), true)
        ]);
    }

    public function detailAjuanJabatanFungsional($id)
    {
        return view('Profil.JabatanFungsional.Ajuan.Id', [
            'data' => json_decode(Sister::detailAjuanJapung($id), true)
        ]);
    }

    public function kepangkatan()
    {
        return view('Profil.Kepangkatan.Index', [
            'data' => json_decode(Sister::kepangkatan(session('id_sdm')), true)
        ]);
    }

    public function detailKepangkatan($id)
    {
        return view('Profil.Kepangkatan.Id', [
            'data' => json_decode(Sister::detailKepangkatan($id), true)
        ]);
    }

    public function penempatan()
    {
        return view('Profil.Penempatan.Index', [
            'data' => json_decode(Sister::penugasan(session('id_sdm')), true)
        ]);
    }

    public function detailPenempatan($id)
    {
        return view('Profil.Penempatan.Id', [
            'data' => json_decode(Sister::detailPenugasan($id), true)
        ]);
    }
}
