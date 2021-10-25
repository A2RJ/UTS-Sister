<?php

namespace App\API;

use Illuminate\Http\Request;

/**
 * Pengujian Mahasiswa
 */
trait PengujianMahasiswa
{
    public static function getPengujianMahasiswa($id_sdm, $id_semester)
    {
        return self::get("/pengujian_mahasiswa?id_sdm=$id_sdm&id_semester=$id_semester");
    }

    public static function getPengujianMahasiswaID($id_aktivitas_mahasiswa)
    {
        return self::get("/pengujian_mahasiswa/$id_aktivitas_mahasiswa");
    }

    public static function getPengujianMahasiswaBidang($id_aktivitas_mahasiswa)
    {
        return self::get("/pengujian_mahasiswa/$id_aktivitas_mahasiswa/bidang_ilmu");
    }

    public static function putPengujianMahasiswa(Request $request)
    {
        return self::put("/pengujian_mahasiswa/$request->id_aktivitas_mahasiswa/bidang_ilmu", [
            $request->id_kelompok_bidang
        ]);
    }
}
