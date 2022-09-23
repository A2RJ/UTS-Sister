<?php

namespace App\Http\Controllers;

use App\Services\Sister;
use Illuminate\Http\Request;

class PelaksPendidikanController extends Controller
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

    public function bimbinganMhs($id_semester)
    {
        return Sister::bimbinganMhs(session('id_sdm'), $id_semester);
    }

    public function detailBimbinganMhs($id)
    {
        return Sister::detailBimbinganMhs($id);
    }

    public function bidangIlmuBimbinganMhs($id)
    {
        return Sister::bidangIlmuBimbinganMhs($id);
    }

    public function pengujianMhs($id_semester)
    {
        return Sister::pengujianMhs(session('id_sdm'), $id_semester);
    }

    public function detailPengujianMhs($id)
    {
        return Sister::detailPengujianMhs($id);
    }

    public function bidangIlmuPengujianMhs($id)
    {
        return Sister::bidangIlmuPengujianMhs($id);
    }

    public function vistingScientist()
    {
        return Sister::visitingScientist(session('id_sdm'));
    }

    public function detailVistingScientist($id)
    {
        return Sister::detailVisitingScientist($id);
    }

    public function bahanAjar()
    {
        return Sister::bahanAjar(session('id_sdm'));
    }

    public function detailBahanAjar($id)
    {
        return Sister::detailBahanAjar($id);
    }

    public function detasering()
    {
        return Sister::detasering(session('id_sdm'));
    }

    public function detailDetasering($id)
    {
        return Sister::detailDetasering($id);
    }

    public function orasiIlmiah()
    {
        return Sister::orasiIlmiah(session('id_sdm'));
    }

    public function detailOrasiIlmiah($id)
    {
        return Sister::detailOrasiIlmiah($id);
    }

    public function pembimbingDosen()
    {
        return Sister::pembimbingDosen(session('id_sdm'));
    }

    public function detailPembimbingDosen($id)
    {
        return Sister::detailPembimbingDosen($id);
    }

    public function tugasTambahan()
    {
        return Sister::tugasTambahan(session('id_sdm'));
    }

    public function detailTugasTambahan($id)
    {
        return Sister::detailTugasTambahan($id);
    }
}
