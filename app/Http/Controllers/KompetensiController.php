<?php

namespace App\Http\Controllers;

use App\Services\Sister;

class KompetensiController extends Controller
{
    public function sertifikasiProfesi()
    {
        return view('Kompetensi.SertifikasiProfesi.Index', [
            'data' => Sister::sertifikasiProfesi((session('id_sdm')))
        ]);
    }

    public function detailSertifikasiProfesi($id)
    {
        return view('Kompetensi.SertifikasiProfesi.Id', [
            'data' => Sister::detailSertifikasiProfesi($id)
        ]);
    }

    public function tes()
    {
        return view('Kompetensi.Tes.Index', [
            'data' => Sister::tes((session('id_sdm')))
        ]);
    }

    public function detailTes($id)
    {
        return view('Kompetensi.Tes.Id', [
            'data' => Sister::detailTes($id)
        ]);
    }

    public function ajuanTes()
    {
        return view('Kompetensi.Tes.Ajuan.Index', [
            'data' => Sister::ajuanTes((session('id_sdm')))
        ]);
    }

    public function detailAjuanTes($id)
    {
        return view('Kompetensi.Tes.Ajuan.Id', [
            'data' => Sister::detailAjuanTes($id)
        ]);
    }
}
