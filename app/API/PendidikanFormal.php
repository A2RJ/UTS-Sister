<?php

namespace App\API;

/**
 * Pendidikan Formal
 */
trait PendidikanFormal
{
    public static function getPendidikanFormal($id_sdm)
    {
        return self::get("/pendidikan_formal?id_sdm=$id_sdm");
    }

    public static function postPendidikanFormal($request)
    {
        return self::post("/pendidikan_formal", [
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
    public static function getPendidikanFormalID($id_pendidikan_formal)
    {
        return self::get("/pendidikan_formal/$id_pendidikan_formal");
    }

    public static function putPendidikanFormal($request)
    {
        return self::put("/pendidikan_formal/$request->id_pendidikan_formal", [
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

    public static function deletePendidikanFormal($id_pendidikan_formal)
    {
        return self::delete("/pendidikan_formal/$id_pendidikan_formal");
    }

    public static function getPendidikanFormalAjuan($request)
    {
        return self::get("/pendidikan_formal/ajuan", [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function getPendidikanFormalAjuanID($id_pendidikan_formal)
    {
        return self::get("/pendidikan_formal/ajuan/$id_pendidikan_formal");
    }
}
