<?php

namespace App\API;

/**
 * Pembicara
 */
trait Pembicara
{
    public static function getPembicara($id_sdm)
    {
        return self::get("/pembicara?id_sdm=$id_sdm");
    }

    public static function postPembicara($request)
    {
        return self::post("/pembicara", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_kategori_capaian_luaran" => $request->id_kategori_capaian_luaran,
            "id_penelitian_pengabdian" => $request->id_penelitian_pengabdian,
            "id_kategori_pembicara" => $request->id_kategori_pembicara,
            "judul_makalah" => $request->judul_makalah,
            "nama_pertemuan" => $request->nama_pertemuan,
            "id_tingkat_pertemuan" => $request->id_tingkat_pertemuan,
            "penyelenggara" => $request->penyelenggara,
            "tanggal_pelaksanaan" => $request->tanggal_pelaksanaan,
            "bahasa" => $request->bahasa,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getPembicaraID($id_Pembicara)
    {
        return self::get("/pembicara/$id_Pembicara");
    }

    public static function putPembicara($request)
    {
        return self::put("/pembicara/$request->id_Pembicara", [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_kategori_capaian_luaran" => $request->id_kategori_capaian_luaran,
            "id_penelitian_pengabdian" => $request->id_penelitian_pengabdian,
            "id_kategori_pembicara" => $request->id_kategori_pembicara,
            "judul_makalah" => $request->judul_makalah,
            "nama_pertemuan" => $request->nama_pertemuan,
            "id_tingkat_pertemuan" => $request->id_tingkat_pertemuan,
            "penyelenggara" => $request->penyelenggara,
            "tanggal_pelaksanaan" => $request->tanggal_pelaksanaan,
            "bahasa" => $request->bahasa,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deletePembicara($id_Pembicara)
    {
        return self::delete("/pembicara/$id_Pembicara");
    }
}
