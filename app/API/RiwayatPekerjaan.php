<?php

namespace App\API;

/**
 * Riwayat Pekerjaan
 */
trait RiwayatPekerjaan
{
    public static function getRiwayatPekerjaan($request)
    {
        return self::get(`/riwayat_pekerjaan`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postRiwayatPekerjaan($request)
    {
        return self::post(`/riwayat_pekerjaan`, [
            "id_sdm" => $request->id_sdm,
            "id_bidang_usaha" => $request->id_bidang_usaha,
            "id_jenis_pekerjaan" => $request->id_jenis_pekerjaan,
            "nama_jabatan" => $request->nama_jabatan,
            "instansi" => $request->instansi,
            "divisi" => $request->divisi,
            "deskripsi_kerja" => $request->deskripsi_kerja,
            "mulai_bekerja" => $request->mulai_bekerja,
            "selesai_bekerja" => $request->selesai_bekerja,
            "luar_negeri" => $request->luar_negeri,
            "dokumen" => [$request->dokumen],
        ]);
    }
    public static function getRiwayatPekerjaanID($id_riwayat_pekerjaan)
    {
        return self::get(`/riwayat_pekerjaan/$id_riwayat_pekerjaan`);
    }

    public static function putRiwayatPekerjaan($request)
    {
        return self::put(`/riwayat_pekerjaan/$request->id_riwayat_pekerjaan`, [
            "id_sdm" => $request->id_sdm,
            "id_bidang_usaha" => $request->id_bidang_usaha,
            "id_jenis_pekerjaan" => $request->id_jenis_pekerjaan,
            "nama_jabatan" => $request->nama_jabatan,
            "instansi" => $request->instansi,
            "divisi" => $request->divisi,
            "deskripsi_kerja" => $request->deskripsi_kerja,
            "mulai_bekerja" => $request->mulai_bekerja,
            "selesai_bekerja" => $request->selesai_bekerja,
            "luar_negeri" => $request->luar_negeri,
            "dokumen" => [$request->dokumen],
        ]);
    }

    public static function deleteRiwayatPekerjaan($id_riwayat_pekerjaan)
    {
        return self::delete(`/riwayat_pekerjaan/$id_riwayat_pekerjaan`);
    }
}
