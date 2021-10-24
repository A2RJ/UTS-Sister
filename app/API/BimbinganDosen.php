<?php

namespace App\API;

/**
 * Bimbingan Dosen
 */
trait BimbinganDosen
{
    public static function getBimbinganDosen($request)
    {
        return self::get(`/bimbing_dosen`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function getBimbinganDosenID($id_bimbingan_dosen)
    {
        return self::get(`/bimbing_dosen/$id_bimbingan_dosen`);
    }
}
