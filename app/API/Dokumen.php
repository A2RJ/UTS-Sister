<?php

namespace App\API;

use Illuminate\Support\Facades\Http;

/**
 * Dokumen
 */
trait Dokumen
{
    public static function getDokumen()
    {
        return self::get('/dokumen');
    }

    public static function postDokumen($request)
    {
        return Http::attach(
            'file',
            $request->file,
            'photo.jpg'
        )->post(`/dokumen`, [
            'id_jenis_dokumen' => $request->id_jenis_dokumen,
            'nama' => $request->nama,
            'tautan' => $request->tautan,
            'keterangan' => $request->keterangan,
        ]);
    }

    public static function getDokumenID($param)
    {
        return self::get(`/dokumen/$param`);
    }

    public static function postDokumenID($request)
    {
        return Http::attach(
            'file',
            $request->file,
            'photo.jpg'
        )->post(`/dokumen/$request->id`, [
            'id_jenis_dokumen' => $request->id_jenis_dokumen,
            'nama' => $request->nama,
            'tautan' => $request->tautan,
            'keterangan' => $request->keterangan,
        ]);
    }

    public static function deleteDokumenID($param)
    {
        return self::deleteID(`/dokumen/$param/`);
    }

    public static function downloadDokumenID($param)
    {
        return self::get(`/dokumen/$param/download`)->download(public_path('/'));
    }
}
