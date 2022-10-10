<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class KualifikasiController extends Controller
{
    public function pendidikanFormal()
    {
        return view('Kualifikasi.PendidikanFormal.Index', [
            'data' => json_decode(Sister::pendidikanFormal(session('id_sdm')), true)
        ]);
    }

    public function detailPendidikanFormal($id)
    {
        return view('Kualifikasi.PendidikanFormal.Id', [
            'data' => json_decode(Sister::detailPendidikanFormal($id), true)
        ]);
    }

    public function ajuanPendidikanFormal()
    {
        return view('Kualifikasi.PendidikanFormal.Ajuan.Index', [
            'data' => json_decode(Sister::ajuanPendidikanFormal(session('id_sdm')), true)
        ]);
    }

    public function detailAjuanPendidikanFormal($id)
    {
        return view('Kualifikasi.PendidikanFormal.Ajuan.Id', [
            'data' => json_decode(Sister::detailAjuanPendidikanFormal($id), true)
        ]);
    }

    public function diklat()
    {
        return view('Kualifikasi.Diklat.Index', [
            'data' => json_decode(Sister::diklat(session('id_sdm')), true)
        ]);
    }

    public function detailDiklat($id)
    {
        return view('Kualifikasi.Diklat.Id', [
            'data' => json_decode(Sister::detailDiklat($id), true)
        ]);
    }

    public function riwayatPekerjaan()
    {
        return view('Kualifikasi.RiwayatPekerjaan.Index', [
            'data' => json_decode(Sister::riwayat_pekerjaan(session('id_sdm')), true)
        ]);
    }

    public function detailRiwayatPekerjaan($id)
    {
        return view('Kualifikasi.RiwayatPekerjaan.Id', [
            'data' => json_decode(Sister::detailRiwayatPekerjaan($id), true)
        ]);
    }
}
