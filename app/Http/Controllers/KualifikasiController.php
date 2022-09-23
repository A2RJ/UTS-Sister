<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class KualifikasiController extends Controller
{
    public function pendidikanFormal()
    {
        return Sister::pendidikanFormal(session('id_sdm'));
    }

    public function detailPendidikanFormal($id)
    {
        return Sister::detailPendidikanFormal($id);
    }

    public function ajuanPendidikanFormal()
    {
        return Sister::ajuanPendidikanFormal(session('id_sdm'));
    }

    public function detailAjuanPendidikanFormal($id)
    {
        return Sister::detailAjuanPendidikanFormal($id);
    }

    public function diklat()
    {
        return Sister::diklat(session('id_sdm'));
    }

    public function detailDiklat($id)
    {
        return Sister::detailDiklat($id);
    }

    public function riwayatPekerjaan()
    {
        return Sister::riwayat_pekerjaan(session('id_sdm'));
    }

    public function detailRiwayatPekerjaan($id)
    {
        return Sister::detailRiwayatPekerjaan($id);
    }
}
