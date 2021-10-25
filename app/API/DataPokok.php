<?php

namespace App\API;

use Illuminate\Support\Facades\Http;

/**
 * Data pokok
 */
trait DataPokok
{
    public static function getAjuan($id_sdm)
    {
        return self::get("/data_pribadi/ajuan?id_sdm=$id_sdm");
    }

    public static function getAjuanID($id)
    {
        return self::get("/data_pribadi/ajuan/$id");
    }

    public static function getAlamat($id)
    {
        return self::get("/data_pribadi/alamat/$id");
    }

    public static function putAlamatID($request)
    {
        return self::put("/data_pribadi/alamat/$request->id_sdm", [
            "email" => $request->email,
            "alamat" => $request->alamat,
            "rt" => $request->rt,
            "rw" => $request->rw,
            "dusun" => $request->dusun,
            "kelurahan" => $request->kelurahan,
            "id_kota_kabupaten" => $request->id_kota_kabupaten,
            "kode_pos" => $request->kode_pos,
            "telepon_rumah" => $request->telepon_rumah,
            "telepon_hp" => $request->telepon_hp,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function getBidangIlmu($id_sdm)
    {
        return self::get("/data_pribadi/bidang_ilmu/$id_sdm");
    }

    public static function putBidangIlmu($request)
    {
        return self::put("/data_pribadi/bidang_ilmu/$request->id_sdm", [$request->id]);
    }

    public static function getFoto($id_sdm)
    {
        return self::get("/data_pribadi/foto/$id_sdm");
    }

    public static function postFoto($request)
    {
        return Http::attach(
            'file',
            $request->file,
            'photo.jpg'
        )->post("/data_pribadi/foto/$request->id_sdm");
    }

    public static function getKeluarga($id_sdm)
    {
        return self::get("/data_pribadi/keluarga/$id_sdm");
    }

    public static function putKeluarga($request)
    {
        return self::put("/data_pribadi/keluarga/$request->id_sdm", [
            "nama_pasangan" => $request->nama_pasangan,
            "nip_pasangan" => $request->nip_pasangan,
            "id_pekerjaan_pasangan" => $request->id_pekerjaan_pasangan,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function getKepegawaian($id_sdm)
    {
        return self::get("/data_pribadi/kepegawaian/$id_sdm");
    }

    public static function getKependudukan($id_sdm)
    {
        return self::get("/data_pribadi/kependudukan/$id_sdm");
    }

    public static function getLain($id_sdm)
    {
        return self::get("/data_pribadi/lain/$id_sdm");
    }

    public static function putLain($request)
    {
        return self::put("/data_pribadi/lain/$request->id_sdm", [
            "npwp" => $request->npwp,
            "nama_wp" => $request->nama_wp,
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function getProfil($id_sdm)
    {
        return self::get("/data_pribadi/profil/$id_sdm");
    }
}
