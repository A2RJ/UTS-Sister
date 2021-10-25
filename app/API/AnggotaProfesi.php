<?php

namespace App\API;

use Illuminate\Http\Request;

/**
 * Anggota Profesi
 */
trait AnggotaProfesi
{
    static $AnggotaProfesi = [
        "view" => ["create", "read", "update"],
        "id_sdm" => 'text',
        "id_kategori_kegiatan" => 'text',
        "nama_organisasi" => 'text',
        "peran" => 'text',
        "tanggal_mulai_keanggotaan" => 'date',
        "tanggal_selesai_keanggotaan" => 'date',
        "instansi_profesi" => 'text',
        "tanggal_selesai_jabatan" => 'date',
        "dokumen" => 'file'
    ];

    private function validate($request)
    {
        return $request->validate([
            "id_sdm" => 'required',
            "id_kategori_kegiatan" => 'required',
            "nama_organisasi" => 'required',
            "peran" => 'required',
            "tanggal_mulai_keanggotaan" => 'required',
            "tanggal_selesai_keanggotaan" => 'required',
            "instansi_profesi" => 'required',
            "tanggal_selesai_jabatan" => 'required',
            "dokumen" => 'required',
        ]);
    }
    public static function getAnggotaProfesi($id_sdm)
    {
        return self::get("/anggota_profesi?id_sdm=$id_sdm");
    }

    public static function postAnggotaProfesi(Request $request)
    {
        $self = new Self;
        $self->validate($request);

        return self::post("/anggota_profesi", [
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
        return self::get("/anggota_profesi/$id_anggota_profesi");
    }

    public static function putAnggotaProfesi(Request $request)
    {
        $self = new Self;
        $self->validate($request);
        
        return self::put("/anggota_profesi/$request->id_anggota_profesi", [
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
        return self::delete("/anggota_profesi/$id_anggota_profesi");
    }
}
