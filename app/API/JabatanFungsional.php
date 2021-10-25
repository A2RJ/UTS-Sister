<?php

namespace App\API;

/**
 * Jabatan Fungsional
 */
trait JabatanFungsional
{
    static $JabatanFungsional = [
        "view" => ["create", "read", "update"],
        "id_sdm" => "text",
        "id_jabatan_fungsional" => "text",
        "sk" => "text",
        "tanggal_mulai" => "date",
        "angka_kredit" => "text",
        "kelebihan_pengajaran" => "textarea",
        "kelebihan_penelitian" => "textarea",
        "kelebihan_pengabdian" => "textarea",
        "kelebihan_penunjang" => "textarea",
        "dokumen" => "file"
    ];

    public static function getJabatanFungsional($id_sdm)
    {
        return self::get("/jabatan_fungsional?id_sdm=$id_sdm");
    }

    public static function postJabatanFungsional($request)
    {
        return self::post("/jabatan_fungsional", [
            "id_sdm" => $request->id_sdm,
            "id_jabatan_fungsional" => $request->id_jabatan_fungsional,
            "sk" => $request->sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "angka_kredit" => $request->angka_kredit,
            "kelebihan_pengajaran" => $request->kelebihan_pengajaran,
            "kelebihan_penelitian" => $request->kelebihan_penelitian,
            "kelebihan_pengabdian" => $request->kelebihan_pengabdian,
            "kelebihan_penunjang" => $request->kelebihan_penunjang,
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function getJabatanFungsionalID($id_jabatan_fungsional)
    {
        return self::get("/jabatan_fungsional/$id_jabatan_fungsional");
    }

    public static function putJabatanFungsional($request)
    {
        return self::put("/jabatan_fungsional/$request->id_jabatan_fungsional", [
            "id_sdm" => $request->id_sdm,
            "id_jabatan_fungsional" => $request->id_jabatan_fungsional,
            "sk" => $request->sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "angka_kredit" => $request->angka_kredit,
            "kelebihan_pengajaran" => $request->kelebihan_pengajaran,
            "kelebihan_penelitian" => $request->kelebihan_penelitian,
            "kelebihan_pengabdian" => $request->kelebihan_pengabdian,
            "kelebihan_penunjang" => $request->kelebihan_penunjang,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deleteJabatanFungsional($request)
    {
        return self::delete("/jabatan_fungsional/$request->id_jabatan_fungsional", [
            "dokumen" => $request->dokumen
        ]);
    }

    public static function getJabatanFungsionalAjuan($id_sdm)
    {
        return self::get("/jabatan_fungsional/ajuan/", [
            "id_sdm" => $id_sdm
        ]);
    }

    public static function getJabatanFungsionalAjuanID($id_sdm)
    {
        return self::get("/jabatan_fungsional/ajuan/$id_sdm");
    }
}
