<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    public function sertfikasiProfesi()
    {
        return view('SertifikasiProfesi', [
            Sister::sertifikasiProfesi((session('id_sdm')))
        ]);
    }

    public function detailSertifikasiProfesi($id)
    {
        return Sister::detailSertifikasiProfesi($id);
    }

    public function nilaiTes()
    {
        return Sister::nilaiTes((session('id_sdm')));
    }

    public function detailNilaiTes($id)
    {
        return Sister::detailNilaiTes($id);
    }

    public function ajuanNilaiTes()
    {
        return Sister::ajuanNilaiTes((session('id_sdm')));
    }

    public function detailAjuanNilaiTes($id)
    {
        return Sister::detailAjuanNilaiTes($id);
    }
}
