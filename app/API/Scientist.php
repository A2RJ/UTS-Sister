<?php

namespace App\API;

/**
 * Scientist
 */
trait Scientist
{
    public static function getScientist($request)
    {
        return self::get(`/visiting_scientist`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postScientist($request)
    {
        return self::post(`/visiting_scientist`, [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_kategori_capaian_luaran" => $request->id_kategori_capaian_luaran,
            "id_penelitian_pengabdian" => $request->id_penelitian_pengabdian,
            "id_perguruan_tinggi" => $request->id_perguruan_tinggi,
            "perguruan_tinggi" => $request->perguruan_tinggi,
            "lama_kegiatan" => $request->lama_kegiatan,
            "kegiatan_penting" => $request->kegiatan_penting,
            "tanggal" => $request->tanggal,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
        ]);
    }
    public static function getScientistID($id_visiting_scientist)
    {
        return self::get(`/visiting_scientist/$id_visiting_scientist`);
    }

    public static function putScientist($request)
    {
        return self::put(`/visiting_scientist/$request->id_visiting_scientist`, [
            "id_sdm" => $request->id_sdm,
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_kategori_capaian_luaran" => $request->id_kategori_capaian_luaran,
            "id_penelitian_pengabdian" => $request->id_penelitian_pengabdian,
            "id_perguruan_tinggi" => $request->id_perguruan_tinggi,
            "perguruan_tinggi" => $request->perguruan_tinggi,
            "lama_kegiatan" => $request->lama_kegiatan,
            "kegiatan_penting" => $request->kegiatan_penting,
            "tanggal" => $request->tanggal,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
        ]);
    }

    public static function deleteScientist($id_visiting_scientist)
    {
        return self::delete(`/visiting_scientist/$id_visiting_scientist`);
    }
}
