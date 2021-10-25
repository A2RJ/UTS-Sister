<?php

namespace App\API;

/**
 * Sertifikasi Profesi
 */
trait SertifikasiProfesi
{
    public static function getSertifikasiProfesi($id_sdm)
    {
        return self::get("/sertifikasi_profesi?id_sdm=$id_sdm");
    }

    public static function postSertifikasiProfesi($request)
    {
        return self::post("/sertifikasi_profesi", [
            "id_sdm" => $request->id_sdm,
            "id_jenis_sertifikasi" => $request->id_jenis_sertifikasi,
            "id_bidang_studi" => $request->id_bidang_studi,
            "tahun_sertifikasi" => $request->tahun_sertifikasi,
            "sk_sertifikasi" => $request->sk_sertifikasi,
            "nomor_registrasi" => $request->nomor_registrasi,
        ]);
    }
    public static function getSertifikasiProfesiID($id_sertifikasi_profesi)
    {
        return self::get("/sertifikasi_profesi/$id_sertifikasi_profesi");
    }

    public static function putSertifikasiProfesi($request)
    {
        return self::put("/sertifikasi_profesi/$request->id_sertifikasi_profesi", [
            "id_sdm" => $request->id_sdm,
            "id_jenis_sertifikasi" => $request->id_jenis_sertifikasi,
            "id_bidang_studi" => $request->id_bidang_studi,
            "tahun_sertifikasi" => $request->tahun_sertifikasi,
            "sk_sertifikasi" => $request->sk_sertifikasi,
            "nomor_registrasi" => $request->nomor_registrasi,
        ]);
    }

    public static function deleteSertifikasiProfesi($id_sertifikasi_profesi)
    {
        return self::delete("/sertifikasi_profesi/$id_sertifikasi_profesi");
    }
}
