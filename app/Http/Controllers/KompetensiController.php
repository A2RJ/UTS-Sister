<?php

namespace App\Http\Controllers;

use App\Services\Sister;

class KompetensiController extends Controller
{
    public function sertifikasiProfesi()
    {
        return view('Kompetensi.SertifikasiProfesi.Index', [
            'data' => [
                "dosen" => json_decode(Sister::sertifikasiDosen(session('id_sdm')), true),
                "profesi" => json_decode(Sister::sertifikasiProfesi(session('id_sdm')), true),
            ]
        ]);
    }

    public function detailSertifikasiProfesi($id)
    {
        return view('Kompetensi.SertifikasiProfesi.Id', [
            'data' => json_decode(Sister::detailSertifikasiProfesi($id), true)
        ]);
    }

    public function detailSertifikasiDosen($id)
    {
        return view('Kompetensi.SertifikasiDosen.Id', [
            'data' => json_decode(Sister::detailSertifikasiDosen($id), true)
        ]);
    }

    public function tes()
    {
        return view('Kompetensi.Tes.Index', [
            'data' => json_decode(Sister::tes(session('id_sdm')), true)
        ]);
    }

    public function detailTes($id)
    {
        return view('Kompetensi.Tes.Id', [
            'data' => json_decode(Sister::detailTes($id), true)
        ]);
    }

    public function ajuanTes()
    {
        return view('Kompetensi.Tes.Ajuan.Index', [
            'data' => json_decode(Sister::ajuanTes(session('id_sdm')), true)
        ]);
    }

    public function detailAjuanTes($id)
    {
        return view('Kompetensi.Tes.Ajuan.Id', [
            'data' => json_decode(Sister::detailAjuanTes($id), true)
        ]);
    }
}
