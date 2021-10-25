<?php

namespace App\API;

use Illuminate\Support\Facades\Http;

/**
 * Dokumen
 */
trait Dokumen
{
    static $Dokumen = [
        "view" => ["create"],
        'id_jenis_dokumen' => "selelct",
        'nama' => "text",
        'tautan' => "text",
        'keterangan' => "textarea",
    ];

    public static function getDokumen($id_sdm)
    {
        return self::get("/dokumen?id_sdm=$id_sdm");
    }

    public static function postDokumen($request)
    {
        return Http::attach(
            'file',
            $request->file,
            'photo.jpg'
        )->post("/dokumen", [
            'id_jenis_dokumen' => $request->id_jenis_dokumen,
            'nama' => $request->nama,
            'tautan' => $request->tautan,
            'keterangan' => $request->keterangan,
        ]);
    }

    public static function getDokumenID($param)
    {
        return self::get("/dokumen/$param");
    }

    public static function postDokumenID($request)
    {
        return Http::attach(
            'file',
            $request->file,
            'photo.jpg'
        )->post("/dokumen/$request->id", [
            'id_jenis_dokumen' => $request->id_jenis_dokumen,
            'nama' => $request->nama,
            'tautan' => $request->tautan,
            'keterangan' => $request->keterangan,
        ]);
    }

    public static function deleteDokumenID($param)
    {
        return self::deleteID("/dokumen/$param/");
    }

    public static function downloadDokumenID($param)
    {
        return self::get("/dokumen/$param/download")->download(public_path('/'));
    }
}
