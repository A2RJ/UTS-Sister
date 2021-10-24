<?php

namespace App\API;

/**
 * Beasiswa
 */
trait Beasiswa
{
    public static function getBeasiswa($request)
    {
        return self::get(`/beasiswa`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postBeasiswa($request)
    {
        return self::post(`/beasiswa`, [
            "id_sdm" => $request->id_sdm,
            "id_jenis_beasiswa" => $request->id_jenis_beasiswa,
            "nama" => $request->nama,
            "tahun_mulai" => $request->tahun_mulai,
            "tahun_selesai" => $request->tahun_selesai,
            "masih_menerima" => $request->masih_menerima,
        ]);
    }
    public static function getBeasiswaID($id_beasiswa)
    {
        return self::get(`/beasiswa/$id_beasiswa`);
    }

    public static function putBeasiswa($request)
    {
        return self::put(`/beasiswa/$request->id_beasiswa`, [
            "id_sdm" => $request->id_sdm,
            "id_jenis_beasiswa" => $request->id_jenis_beasiswa,
            "nama" => $request->nama,
            "tahun_mulai" => $request->tahun_mulai,
            "tahun_selesai" => $request->tahun_selesai,
            "masih_menerima" => $request->masih_menerima,
        ]);
    }

    public static function deleteBeasiswa($id_beasiswa)
    {
        return self::delete(`/beasiswa/$id_beasiswa`);
    }
}
