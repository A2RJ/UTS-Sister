<?php

namespace App\API;

/**
 * Datasering
 */
trait Datasering
{
    static $Datasering = [
        "view" => ["create", "read", "update"],
        "id_sdm" => "text",
        "id_kategori_kegiatan" => "select",
        "id_perguruan_tinggi" => "select",
        "tanggal_mulai" => "date",
        "tanggal_selesai" => "date",
        "bidang_tugas" => "text",
        "deskripsi_kegiatan" => "textarea",
        "metode_pelaksanaan" => "text",
        "sk_penugasan" => "text",
        "tanggal_sk_penugasan" => "date",
        "dokumen" => "text",
    ];

    public static function getDatasering($id_sdm)
    {
        return self::get("/detasering?id_sdm=$id_sdm");
    }

    public static function postDatasering($request)
    {
        return self::post("/detasering", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_perguruan_tinggi" => $request->id_perguruan_tinggi,
            "tanggal_mulai" => $request->tanggal_mulai,
            "tanggal_selesai" => $request->tanggal_selesai,
            "bidang_tugas" => $request->bidang_tugas,
            "deskripsi_kegiatan" => $request->deskripsi_kegiatan,
            "metode_pelaksanaan" => $request->metode_pelaksanaan,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function getDataseringID($id_datasering)
    {
        return self::get("/detasering/$id_datasering");
    }

    public static function putDatasering($request)
    {
        return self::put("/detasering/$request->id_datasering", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_perguruan_tinggi" => $request->id_perguruan_tinggi,
            "tanggal_mulai" => $request->tanggal_mulai,
            "tanggal_selesai" => $request->tanggal_selesai,
            "bidang_tugas" => $request->bidang_tugas,
            "deskripsi_kegiatan" => $request->deskripsi_kegiatan,
            "metode_pelaksanaan" => $request->metode_pelaksanaan,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function deleteDatasering($id_datasering)
    {
        return self::delete("/detasering/$id_datasering");
    }
}
