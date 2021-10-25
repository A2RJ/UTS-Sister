<?php

namespace App\API;

/**
 * Inpassing
 */
trait Inpassing
{
    public static function getInpassing($id_sdm)
    {
        return self::get("/inpassing?id_sdm=$id_sdm");
    }

    public static function postInpassing($request)
    {
        return self::post("/inpassing", [
            "id_sdm" => $request->id_sdm,
            "id_pangkat_golongan" => $request->id_pangkat_golongan,
            "sk" => $request->sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "angka_kredit" => $request->angka_kredit,
            "masa_kerja_tahun" => $request->masa_kerja_tahun,
            "masa_kerja_bulan" => $request->masa_kerja_bulan,
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function getInpassingID($id_inpassing)
    {
        return self::get("/inpassing/$id_inpassing");
    }

    public static function putInpassing($request)
    {
        return self::put("/inpassing/$request->id_inpassing", [
            "id_sdm" => $request->id_sdm,
            "id_pangkat_golongan" => $request->id_pangkat_golongan,
            "sk" => $request->sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "angka_kredit" => $request->angka_kredit,
            "masa_kerja_tahun" => $request->masa_kerja_tahun,
            "masa_kerja_bulan" => $request->masa_kerja_bulan,
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function deleteInpassing($id_inpassing)
    {
        return self::delete("/inpassing/$id_inpassing");
    }
}
