<?php

namespace App\Http\Controllers\BKD;

use App\Http\Controllers\Controller;
use App\Services\Sister;

class PelaksPendidikanController extends Controller
{
    public function Pengajaran()
    {
        return view('PelaksPendidikan.Pengajaran.Index', [
            'data' => json_decode(Sister::pengajaran(session('id_sdm')), true)
        ]);
    }

    public function detailPengajaran($id)
    {
        return view('PelaksPendidikan.Pengajaran.Id', [
            'data' => json_decode(Sister::detailPengajaran($id), true)
        ]);
    }

    public function bidangIlmuPengajaran()
    {
        return view('PelaksPendidikan.Pengajaran.BidangIlmu', [
            'data' => json_decode(Sister::bidangIlmuPengajaran(session('id_sdm')), true)
        ]);
    }

    public function bimbinganMhs($id_semester = '')
    {
        return view('PelaksPendidikan.BimbinganMhs.Index', [
            'data' => json_decode(Sister::bimbinganMhs(session('id_sdm'), $id_semester), true)
        ]);
    }

    public function detailBimbinganMhs($id)
    {
        return view('PelaksPendidikan.BimbinganMhs.Id', [
            'data' => json_decode(Sister::detailBimbinganMhs($id), true)
        ]);
    }

    public function bidangIlmuBimbinganMhs($id)
    {
        return view('PelaksPendidikan.BimbinganMhs.BidangIlmu', [
            'data' => json_decode(Sister::bidangIlmuBimbinganMhs($id), true)
        ]);
    }

    public function pengujianMhs($id_semester = '')
    {
        return view('PelaksPendidikan.PengujianMhs.Index', [
            'data' => json_decode(Sister::pengujianMhs(session('id_sdm'), $id_semester), true)
        ]);
    }

    public function detailPengujianMhs($id)
    {
        return view('PelaksPendidikan.PengujianMhs.Id', [
            'data' => json_decode(Sister::detailPengujianMhs($id), true)
        ]);
    }

    public function bidangIlmuPengujianMhs($id)
    {
        return view('PelaksPendidikan.PengujianMhs.BidangIlmu', [
            'data' => json_decode(Sister::bidangIlmuPengujianMhs($id), true)
        ]);
    }

    public function vistingScientist()
    {
        return view('PelaksPendidikan.VisitingScientist.Index', [
            'data' => json_decode(Sister::visitingScientist(session('id_sdm')), true)
        ]);
    }

    public function detailVistingScientist($id)
    {
        return view('PelaksPendidikan.VisitingScientist.Id', [
            'data' => json_decode(Sister::detailVisitingScientist($id), true)
        ]);
    }

    public function bahanAjar()
    {
        return view('PelaksPendidikan.BahanAjar.Index', [
            'data' => json_decode(Sister::bahanAjar(session('id_sdm')), true)
        ]);
    }

    public function detailBahanAjar($id)
    {
        return view('PelaksPendidikan.BahanAjar.Id', [
            'data' => json_decode(Sister::detailBahanAjar($id), true)
        ]);
    }

    public function detasering()
    {
        return view('PelaksPendidikan.Detasering.Index', [
            'data' => json_decode(Sister::detasering(session('id_sdm')), true)
        ]);
    }

    public function detailDetasering($id)
    {
        return view('PelaksPendidikan.Detasering.Id', [
            'data' => json_decode(Sister::detailDetasering($id), true)
        ]);
    }

    public function orasiIlmiah()
    {
        return view('PelaksPendidikan.OrasiIlmiah.Index', [
            'data' => json_decode(Sister::orasiIlmiah(session('id_sdm')), true)
        ]);
    }

    public function detailOrasiIlmiah($id)
    {
        return view('PelaksPendidikan.OrasiIlmiah.Id', [
            'data' => json_decode(Sister::detailOrasiIlmiah($id), true)
        ]);
    }

    public function pembimbingDosen()
    {
        return view('PelaksPendidikan.PembimbingDosen.Index', [
            'data' => json_decode(Sister::pembimbingDosen(session('id_sdm')), true)
        ]);
    }

    public function detailPembimbingDosen($id)
    {
        return view('PelaksPendidikan.PembimbingDosen.Id', [
            'data' => json_decode(Sister::detailPembimbingDosen($id), true)
        ]);
    }

    public function tugasTambahan()
    {
        return view('PelaksPendidikan.TugasTambahan.Index', [
            'data' => json_decode(Sister::tugasTambahan(session('id_sdm')), true)
        ]);
    }

    public function detailTugasTambahan($id)
    {
        return view('PelaksPendidikan.TugasTambahan.Id', [
            'data' => json_decode(Sister::detailTugasTambahan($id), true)
        ]);
    }
}
