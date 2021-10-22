<?php

namespace App\API;

/**
 * Kolaborator
 */
trait Kolaborator
{
    public static function getKolaborator($nama, $nik)
    {
        return self::get('/kolaborator_eksternal', [
            'nama' => $nama,
            'nik' => $nik
        ]);
    }

    public static function postKolaborator($request)
    {
        return self::post('/kolaborator_eksternal', [
            "nama" => $request->nama,
            "kode_negara" => $request->kode_negara,
            "jenis_kelamin" => $request->jenis_kelamin,
            "nik" => $request->nik,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jalan" => $request->jalan,
            "rt" => $request->rt,
            "rw" => $request->rw,
            "dusun" => $request->dusun,
            "kelurahan" => $request->kelurahan,
            "kode_pos" => $request->kode_pos,
            "telepon_rumah" => $request->telepon_rumah,
            "telepon_hp" => $request->telepon_hp,
            "email" => $request->email
        ]);
    }

    public static function getKolaboratorID($params)
    {
        return self::get(`/kolaborator_eksternal/$params`);
    }

    public static function putKolaboratorID($request)
    {
        return self::put(`/kolaborator_eksternal/$request->id`, [
            "nama" => $request->nama,
            "kode_negara" => $request->kode_negara,
            "jenis_kelamin" => $request->jenis_kelamin,
            "nik" => $request->nik,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jalan" => $request->jalan,
            "rt" => $request->rt,
            "rw" => $request->rw,
            "dusun" => $request->dusun,
            "kelurahan" => $request->kelurahan,
            "kode_pos" => $request->kode_pos,
            "telepon_rumah" => $request->telepon_rumah,
            "telepon_hp" => $request->telepon_hp,
            "email" => $request->email
        ]);
    }

    public static function deleteKolaboratorID($param)
    {
        return self::deleteID(`/kolaborator_eksternal/$param`);
    }
}
