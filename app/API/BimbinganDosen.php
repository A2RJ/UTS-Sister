<?php

namespace App\API;

/**
 * Bimbingan Dosen
 */
trait BimbinganDosen
{
    public static function getBimbinganDosen($id_sdm)
    {
        return self::get("/bimbing_dosen?id_sdm=$id_sdm");
    }

    public static function getBimbinganDosenID($id_bimbingan_dosen)
    {
        return self::get("/bimbing_dosen/$id_bimbingan_dosen");
    }
}
