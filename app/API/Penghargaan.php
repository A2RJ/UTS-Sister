<?php

namespace App\API;

/**
 * Penghargaan
 */
trait Penghargaan
{
    public static function getPenghargaan($request)
    {
        return self::get(`/penghargaan`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postPenghargaan($request)
    {
        return self::post(`/penghargaan`, [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_tingkat_penghargaan" => $request->id_tingkat_penghargaan,
            "id_jenis_penghargaan" => $request->id_jenis_penghargaan,
            "nama" => $request->nama,
            "tahun" => $request->tahun,
            "instansi_pemberi" => $request->instansi_pemberi,
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getPenghargaanID($id_penghargaan)
    {
        return self::get(`/penghargaan/$id_penghargaan`);
    }

    public static function putPenghargaan($request)
    {
        return self::put(`/penghargaan/$request->id_penghargaan`, [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_tingkat_penghargaan" => $request->id_tingkat_penghargaan,
            "id_jenis_penghargaan" => $request->id_jenis_penghargaan,
            "nama" => $request->nama,
            "tahun" => $request->tahun,
            "instansi_pemberi" => $request->instansi_pemberi,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deletePenghargaan($id_penghargaan)
    {
        return self::delete(`/penghargaan/$id_penghargaan`);
    }
}
