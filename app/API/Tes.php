<?php

namespace App\API;

/**
 * Tes
 */
trait Tes
{
    public static function getTes($request)
    {
        return self::get(`/nilai_tes`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function getTesID($id_nilai_tes)
    {
        return self::get(`/nilai_tes/$id_nilai_tes`);
    }

    public static function getTesAjuan($request)
    {
        return self::get(`/nilai_tes/ajuan`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postTesAjuan($request)
    {
        return self::post(`/nilai_tes/ajuan`, [
            "id_sdm" => $request->id_sdm,
            "id_jenis_tes" => $request->id_jenis_tes,
            "nama" => $request->nama,
            "penyelenggara" => $request->penyelenggara,
            "tanggal" => $request->tanggal,
            "tahun" => $request->tahun,
            "skor" => $request->skor,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function getTesAjuanID($id_nilai_tes)
    {
        return self::get(`/nilai_tes/ajuan/$id_nilai_tes`);
    }

    public static function putTesAjuan($request)
    {
        return self::put(`/nilai_tes/ajuan/$request->id_nilai_tes`, [
            "id_sdm" => $request->id_sdm,
            "id_jenis_tes" => $request->id_jenis_tes,
            "nama" => $request->nama,
            "penyelenggara" => $request->penyelenggara,
            "tanggal" => $request->tanggal,
            "tahun" => $request->tahun,
            "skor" => $request->skor,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deleteTesAjuan($id_nilai_tes)
    {
        return self::delete(`/nilai_tes/ajuan/$id_nilai_tes`);
    }
}
