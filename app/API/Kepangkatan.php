<?php

namespace App\API;

/**
 * Kepangkatan
 */
trait Kepangkatan
{
    static $Kepangkatan = [
        "id_sdm" => "text",
        "id_pangkat_golongan" => "select",
        "sk" => "text",
        "tanggal_sk" => "date",
        "tanggal_mulai" => "date",
        "masa_kerja_tahun" => "text",
        "masa_kerja_bulan" => "text",
        "dokumen" => "file",
    ];

    public static function getKepangkatan($id_sdm)
    {
        return self::get("/kepangkatan?id_sdm=$id_sdm");
    }

    public static function postKepangkatan($request)
    {
        return self::post("/kepangkatan", [
            "id_sdm" => $request->id_sdm,
            "id_pangkat_golongan" => $request->id_pangkat_golongan,
            "sk" => $request->sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "masa_kerja_tahun" => $request->masa_kerja_tahun,
            "masa_kerja_bulan" => $request->masa_kerja_bulan,
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function getKepangkatanID($id_kepangkatan)
    {
        return self::get("/kepangkatan/$id_kepangkatan");
    }

    public static function putKepangkatan($request)
    {
        return self::put("/kepangkatan/$request->id_kepangkatan", [
            "id_sdm" => $request->id_sdm,
            "id_pangkat_golongan" => $request->id_pangkat_golongan,
            "sk" => $request->sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "masa_kerja_tahun" => $request->masa_kerja_tahun,
            "masa_kerja_bulan" => $request->masa_kerja_bulan,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deleteKepangkatan($request)
    {
        return self::delete("/kepangkatan/$request->id_kepangkatan", [
            "dokumen" => $request->dokumen
        ]);
    }

    public static function getKepangkatanAjuan($id_sdm)
    {
        return self::get("/kepangkatan/ajuan/", [
            "id_sdm" => $id_sdm
        ]);
    }

    public static function getKepangkatanAjuanID($id_sdm)
    {
        return self::get("/kepangkatan/ajuan/$id_sdm");
    }
}
