<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class KualifikasiController extends Controller
{
    public function pendidikanFormal()
    {
        return view('Kualifikasi.PendidikanFormal.Index', [
            'data' => Sister::pendidikanFormal(session('id_sdm'))
        ]);
    }

    public function detailPendidikanFormal($id)
    {
        return view('Kualifikasi.PendidikanFormal.Id', [
            'data' => Sister::detailPendidikanFormal($id)
        ]);
    }

    public function ajuanPendidikanFormal()
    {
        return view('Kualifikasi.PendidikanFormal.Ajuan.Index', [
            'data' => Sister::ajuanPendidikanFormal(session('id_sdm'))
        ]);
    }

    public function detailAjuanPendidikanFormal($id)
    {
        return view('Kualifikasi.PendidikanFormal.Ajuan.Id', [
            'data' => Sister::detailAjuanPendidikanFormal($id)
        ]);
    }

    public function diklat()
    {
        return view('Kualifikasi.Diklat.Index', [
            'data' => Sister::diklat(session('id_sdm'))
        ]);
    }

    public function detailDiklat($id)
    {
        return view('Kualifikasi.Diklat.Id', [
            'data' => Sister::detailDiklat($id)
        ]);
    }

    public function riwayatPekerjaan()
    {
        return view('Kualifikasi.RiwayatPekerjaan.Index', [
            'data' => Sister::riwayat_pekerjaan(session('id_sdm'))
        ]);
    }

    public function detailRiwayatPekerjaan($id)
    {
        return view('Kualifikasi.RiwayatPekerjaan.Id', [
            'data' => Sister::detailRiwayatPekerjaan($id)
        ]);
    }
}
