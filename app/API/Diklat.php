<?php

namespace App\API;

/**
 * Diklat
 */
trait Diklat
{
    static $Diklat = [
        "view" => ["create", "read", "update"],
        "id_sdm" => "select",
        "id_kategori_kegiatan" => "select",
        "id_jenis_diklat" => "select",
        "nama" => "text",
        "penyelenggara" => "text",
        "peran" => "text",
        "tingkat" => "text",
        "jumlah_jam" => "text",
        "no_sertifikat" => "text",
        "tanggal_sertifikat" => "date",
        "tahun" => "date",
        "lokasi" => "text",
        "tanggal_mulai" => "date",
        "tanggal_selesai" => "date",
        "sk_penugasan" => "text",
        "tanggal_sk_penugasan" => "date",
        "dokumen" => "text",
    ];

    public static function getDiklat($id_sdm)
    {
        return self::get("/diklat?id_sdm=$id_sdm");
    }

    public static function postDiklat($request)
    {
        return self::post("/diklat", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_jenis_diklat" => $request->id_jenis_diklat,
            "nama" => $request->nama,
            "penyelenggara" => $request->penyelenggara,
            "peran" => $request->peran,
            "tingkat" => $request->tingkat,
            "jumlah_jam" => $request->jumlah_jam,
            "no_sertifikat" => $request->no_sertifikat,
            "tanggal_sertifikat" => $request->tanggal_sertifikat,
            "tahun" => $request->tahun,
            "lokasi" => $request->lokasi,
            "tanggal_mulai" => $request->tanggal_mulai,
            "tanggal_selesai" => $request->tanggal_selesai,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "dokumen" => [$request->dokumen],
        ]);
    }
    public static function getDiklatID($id_diklat)
    {
        return self::get("/diklat/$id_diklat");
    }

    public static function putDiklat($request)
    {
        return self::put("/diklat/$request->id_diklat", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_jenis_diklat" => $request->id_jenis_diklat,
            "nama" => $request->nama,
            "penyelenggara" => $request->penyelenggara,
            "peran" => $request->peran,
            "tingkat" => $request->tingkat,
            "jumlah_jam" => $request->jumlah_jam,
            "no_sertifikat" => $request->no_sertifikat,
            "tanggal_sertifikat" => $request->tanggal_sertifikat,
            "tahun" => $request->tahun,
            "lokasi" => $request->lokasi,
            "tanggal_mulai" => $request->tanggal_mulai,
            "tanggal_selesai" => $request->tanggal_selesai,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function deleteDiklat($id_diklat)
    {
        return self::delete("/diklat/$id_diklat");
    }
}
