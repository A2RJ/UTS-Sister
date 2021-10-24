<?php

namespace App\API;

/**
 * Tugas Tambahan
 */
trait TugasTambahan
{
    public static function getTugasTambahan($request)
    {
        return self::get(`/tugas_tambahan`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postTugasTambahan($request)
    {
        return self::post(`/tugas_tambahan`, [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_jenis_tugas" => $request->id_jenis_tugas,
            "id_perguruan_tinggi" => $request->id_perguruan_tinggi,
            "id_unit_kerja" => $request->id_unit_kerja,
            "jumlah_jam" => $request->jumlah_jam,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_mulai_tugas" => $request->tanggal_mulai_tugas,
            "tanggal_selesai_tugas" => $request->tanggal_selesai_tugas,
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getTugasTambahanID($id_tugas_tambahan)
    {
        return self::get(`/tugas_tambahan/$id_tugas_tambahan`);
    }

    public static function putTugasTambahan($request)
    {
        return self::put(`/tugas_tambahan/$request->id_tugas_tambahan`, [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_jenis_tugas" => $request->id_jenis_tugas,
            "id_perguruan_tinggi" => $request->id_perguruan_tinggi,
            "id_unit_kerja" => $request->id_unit_kerja,
            "jumlah_jam" => $request->jumlah_jam,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_mulai_tugas" => $request->tanggal_mulai_tugas,
            "tanggal_selesai_tugas" => $request->tanggal_selesai_tugas,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deleteTugasTambahan($id_tugas_tambahan)
    {
        return self::delete(`/tugas_tambahan/$id_tugas_tambahan`);
    }
}
