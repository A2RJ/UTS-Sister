<?php

namespace App\API;

/**
 * Jurnal
 */
trait Jurnal
{
    public static function getJurnal($id_sdm)
    {
        return self::get("/pengelola_jurnal?id_sdm=$id_sdm");
    }

    public static function postJurnal($request)
    {
        return self::post("/pengelola_jurnal", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_media_publikasi" => $request->id_media_publikasi,
            "peran" => $request->peran,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_mulai" => $request->tanggal_mulai,
            "tanggal_selesai" => $request->tanggal_selesai,
            "aktif" => $request->aktif,
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getJurnalID($id_pengelola_jurnal)
    {
        return self::get("/pengelola_jurnal/$id_pengelola_jurnal");
    }

    public static function putJurnal($request)
    {
        return self::put("/pengelola_jurnal/$request->id_pengelola_jurnal", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_media_publikasi" => $request->id_media_publikasi,
            "peran" => $request->peran,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_mulai" => $request->tanggal_mulai,
            "tanggal_selesai" => $request->tanggal_selesai,
            "aktif" => $request->aktif,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deleteJurnal($id_pengelola_jurnal)
    {
        return self::delete("/pengelola_jurnal/$id_pengelola_jurnal");
    }
}
