<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class PelaksPendidikanController extends Controller
{
    public function Pengajaran()
    {
        return view('PelaksPendidikan.Pengajaran.Index', [
            // 'data' => Sister::pengajaran(session('id_sdm'))
        ]);
    }

    public function detailPengajaran($id)
    {
        return view('PelaksPendidikan.Pengajaran.Id', [
            // 'data' => Sister::detailPengajaran($id)
        ]);
    }

    public function bidangIlmuPengajaran()
    {
        return view('PelaksPendidikan.Pengajaran.BidangIlmu', [
            // 'data' => Sister::bidangIlmuPengajaran(session('id_sdm'))
        ]);
    }

    public function bimbinganMhs($id_semester = '')
    {
        return view('PelaksPendidikan.BimbinganMhs.Index', [
            // 'data' => Sister::bimbinganMhs(session('id_sdm'), $id_semester)
        ]);
    }

    public function detailBimbinganMhs($id)
    {
        return view('PelaksPendidikan.BimbinganMhs.Id', [
            // 'data' => Sister::detailBimbinganMhs($id)
        ]);
    }

    public function bidangIlmuBimbinganMhs($id)
    {
        return view('PelaksPendidikan.BimbinganMhs.BidangIlmu', [
            // 'data' => Sister::bidangIlmuBimbinganMhs($id)
        ]);
    }

    public function pengujianMhs($id_semester = '')
    {
        return view('PelaksPendidikan.PengujianMhs.Index', [
            // 'data' => Sister::pengujianMhs(session('id_sdm'), $id_semester)
        ]);
    }

    public function detailPengujianMhs($id)
    {
        return view('PelaksPendidikan.PengujianMhs.Id', [
            // 'data' => Sister::detailPengujianMhs($id)
        ]);
    }

    public function bidangIlmuPengujianMhs($id)
    {
        return view('PelaksPendidikan.PengujianMhs.BidangIlmu', [
            // 'data' => Sister::bidangIlmuPengujianMhs($id)
        ]);
    }

    public function vistingScientist()
    {
        return view('PelaksPendidikan.VisitingScientist.Index', [
            // 'data' => Sister::visitingScientist(session('id_sdm'))
        ]);
    }

    public function detailVistingScientist($id)
    {
        return view('PelaksPendidikan.VisitingScientist.Id', [
            // 'data' => Sister::detailVisitingScientist($id)
        ]);
    }

    public function bahanAjar()
    {
        return view('PelaksPendidikan.BahanAjar.Index', [
            // 'data' => Sister::bahanAjar(session('id_sdm'))
        ]);
    }

    public function detailBahanAjar($id)
    {
        return view('PelaksPendidikan.BahanAjar.Id', [
            // 'data' => Sister::detailBahanAjar($id)
        ]);
    }

    public function detasering()
    {
        return view('PelaksPendidikan.Detasering.Index', [
            // 'data' => Sister::detasering(session('id_sdm'))
        ]);
    }

    public function detailDetasering($id)
    {
        return view('PelaksPendidikan.Detasering.Id', [
            // 'data' => Sister::detailDetasering($id)
        ]);
    }

    public function orasiIlmiah()
    {
        return view('PelaksPendidikan.OrasiIlmiah.Index', [
            // 'data' => Sister::orasiIlmiah(session('id_sdm'))
        ]);
    }

    public function detailOrasiIlmiah($id)
    {
        return view('PelaksPendidikan.OrasiIlmiah.Id', [
            // 'data' => Sister::detailOrasiIlmiah($id)
        ]);
    }

    public function pembimbingDosen()
    {
        return view('PelaksPendidikan.PembimbingDosen.Index', [
            // 'data' => Sister::pembimbingDosen(session('id_sdm'))
        ]);
    }

    public function detailPembimbingDosen($id)
    {
        return view('PelaksPendidikan.PembimbingDosen.Id', [
            // 'data' => Sister::detailPembimbingDosen($id)
        ]);
    }

    public function tugasTambahan()
    {
        return view('PelaksPendidikan.TugasTambahan.Index', [
            // 'data' => Sister::tugasTambahan(session('id_sdm'))
        ]);
    }

    public function detailTugasTambahan($id)
    {
        return view('PelaksPendidikan.TugasTambahan.Id', [
            // 'data' => Sister::detailTugasTambahan($id)
        ]);
    }
}
