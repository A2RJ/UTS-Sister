<?php

namespace App\API;

/**
 * Kesejahteraan
 */
trait Kesejahteraan
{
    public static function getKesejahteraan($id_sdm)
    {
        return self::get("/kesejahteraan?id_sdm=$id_sdm");
    }

    public static function postKesejahteraan($request)
    {
        return self::post("/kesejahteraan", [
            "id_sdm" => $request->id_sdm,
            "id_jenis_kesejahteraan" => $request->id_jenis_kesejahteraan,
            "nama" => $request->nama,
            "penyelenggara" => $request->penyelenggara,
            "tahun_mulai" => $request->tahun_mulai,
            "tahun_selesai" => $request->tahun_selesai,
        ]);
    }
    public static function getKesejahteraanID($id_kesejahteraan)
    {
        return self::get("/kesejahteraan/$id_kesejahteraan");
    }

    public static function putKesejahteraan($request)
    {
        return self::put("/kesejahteraan/$request->id_kesejahteraan", [
            "id_sdm" => $request->id_sdm,
            "id_jenis_kesejahteraan" => $request->id_jenis_kesejahteraan,
            "nama" => $request->nama,
            "penyelenggara" => $request->penyelenggara,
            "tahun_mulai" => $request->tahun_mulai,
            "tahun_selesai" => $request->tahun_selesai,
        ]);
    }

    public static function deleteKesejahteraan($id_kesejahteraan)
    {
        return self::delete("/kesejahteraan/$id_kesejahteraan");
    }
}
