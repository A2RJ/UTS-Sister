<?php

namespace App\API;

/**
 * Orasi Ilmiah
 */
trait OrasiIlmiah
{
    public static function getOrasiIlmiah($id_sdm)
    {
        return self::get(`/orasi_ilmiah`, [
            "id_sdm" => $id_sdm
        ]);
    }

    public static function postOrasiIlmiah($request)
    {
        return self::post(`/orasi_ilmiah`, [
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
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function getOrasiIlmiahID($id_orasi_ilmiah)
    {
        return self::get(`/orasi_ilmiah/$id_orasi_ilmiah`);
    }

    public static function putOrasiIlmiah($request)
    {
        return self::put(`/orasi_ilmiah/$request->id_orasi_ilmiah`, [
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
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function deleteOrasiIlmiah($id_orasi_ilmiah)
    {
        return self::delete(`/orasi_ilmiah/$id_orasi_ilmiah`);
    }
}
