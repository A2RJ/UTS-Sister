<?php

namespace App\API;

/**
 * Anggota Profesi
 */
trait AnggotaProfesi
{
    public static function getAnggotaProfesi($request)
    {
        return self::get(`/anggota_profesi`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postAnggotaProfesi($request)
    {
        return self::post(`/anggota_profesi`, [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "nama_organisasi" => $request->nama_organisasi,
            "peran" => $request->peran,
            "tanggal_mulai_keanggotaan" => $request->tanggal_mulai_keanggotaan,
            "tanggal_selesai_keanggotaan" => $request->tanggal_selesai_keanggotaan,
            "instansi_profesi" => $request->instansi_profesi,
            "tanggal_selesai_jabatan" => $request->tanggal_selesai_jabatan,
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getAnggotaProfesiID($id_anggota_profesi)
    {
        return self::get(`/anggota_profesi/$id_anggota_profesi`);
    }

    public static function putAnggotaProfesi($request)
    {
        return self::put(`/anggota_profesi/$request->id_anggota_profesi`, [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "nama_organisasi" => $request->nama_organisasi,
            "peran" => $request->peran,
            "tanggal_mulai_keanggotaan" => $request->tanggal_mulai_keanggotaan,
            "tanggal_selesai_keanggotaan" => $request->tanggal_selesai_keanggotaan,
            "instansi_profesi" => $request->instansi_profesi,
            "tanggal_selesai_jabatan" => $request->tanggal_selesai_jabatan,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deleteAnggotaProfesi($id_anggota_profesi)
    {
        return self::delete(`/anggota_profesi/$id_anggota_profesi`);
    }
}
