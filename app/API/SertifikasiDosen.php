<?php

namespace App\API;

/**
 * Sertifikasi Dosen
 */
trait SertifikasiDosen
{
    public static function getSertifikasiDosen($id_sdm)
    {
        return self::get("/sertifikasi_dosen?id_sdm=$id_sdm");
    }

    public static function getSertifikasiDosenID($id_sertifikasi_dosen)
    {
        return self::get("/sertifikasi_dosen/$id_sertifikasi_dosen");
    }

    public static function getSertifikasiDosenAjuan($request)
    {
        return self::get("/sertifikasi_dosen/ajuan", [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function getSertifikasiDosenAjuanID($id_sertifikasi_dosen)
    {
        return self::get("/sertifikasi_dosen/ajuan/$id_sertifikasi_dosen");
    }
}
