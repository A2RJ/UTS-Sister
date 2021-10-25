<?php

namespace App\API;

/**
 * Jabatan Struktural
 */
trait JabatanStruktural
{
    public static function getJabatanStruktural($id_sdm)
    {
        return self::get("/jabatan_struktural?id_sdm=$id_sdm");
    }

    public static function postJabatanStruktural($request)
    {
        return self::post("/jabatan_struktural", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_jabatan_negara" => $request->id_jabatan_negara,
            "sk_jabatan" => $request->sk_jabatan,
            "tanggal_mulai_jabatan" => $request->tanggal_mulai_jabatan,
            "tanggal_selesai_jabatan" => $request->tanggal_selesai_jabatan,
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getJabatanStrukturalID($id_jabatan_struktural)
    {
        return self::get("/jabatan_struktural/$id_jabatan_struktural");
    }

    public static function putJabatanStruktural($request)
    {
        return self::put("/jabatan_struktural/$request->id_jabatan_struktural", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_jabatan_negara" => $request->id_jabatan_negara,
            "sk_jabatan" => $request->sk_jabatan,
            "tanggal_mulai_jabatan" => $request->tanggal_mulai_jabatan,
            "tanggal_selesai_jabatan" => $request->tanggal_selesai_jabatan,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deleteJabatanStruktural($id_jabatan_struktural)
    {
        return self::delete("/jabatan_struktural/$id_jabatan_struktural");
    }
}
