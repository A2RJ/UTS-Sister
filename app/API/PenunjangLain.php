<?php

namespace App\API;

/**
 * Penunjang Lain
 */
trait PenunjangLain
{
    public static function getPenunjangLain($request)
    {
        return self::get(`/penunjang_lain`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postPenunjangLain($request)
    {
        return self::post(`/penunjang_lain`, [
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "nama" => $request->nama,
            "id_jenis_kepanitiaan" => $request->id_jenis_kepanitiaan,
            "instansi" => $request->instansi,
            "tingkat" => $request->tingkat,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_mulai" => $request->tanggal_mulai,
            "tanggal_selesai" => $request->tanggal_selesai,
            "anggota_dosen" => [
                [
                    "id_sdm" => $request->id_sdm,
                    "peran" => $request->peran,
                ]
            ],
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getPenunjangLainID($id_penunjang_lain)
    {
        return self::get(`/penunjang_lain/$id_penunjang_lain`);
    }

    public static function putPenunjangLain($request)
    {
        return self::put(`/penunjang_lain/$request->id_penunjang_lain`, [
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "nama" => $request->nama,
            "id_jenis_kepanitiaan" => $request->id_jenis_kepanitiaan,
            "instansi" => $request->instansi,
            "tingkat" => $request->tingkat,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_mulai" => $request->tanggal_mulai,
            "tanggal_selesai" => $request->tanggal_selesai,
            "anggota_dosen" => [
                [
                    "id_sdm" => $request->id_sdm,
                    "peran" => $request->peran,
                ]
            ],
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deletePenunjangLain($id_penunjang_lain)
    {
        return self::delete(`/penunjang_lain/$id_penunjang_lain`);
    }
}
