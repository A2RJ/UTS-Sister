<?php

namespace App\API;

/**
 * Tunjangan
 */
trait Tunjangan
{
    public static function getTunjanganKesejahteraan($request)
    {
        return self::get(`/tunjangan`, [
            "id_sdm" => $request->id_sdm
        ]);
    }

    public static function postTunjanganKesejahteraan($request)
    {
        return self::post(`/tunjangan`, [
            "id_sdm" => $request->id_sdm,
            "id_jenis_tunjangan" => $request->id_jenis_tunjangan,
            "nama" => $request->nama,
            "instansi_pemberi" => $request->instansi_pemberi,
            "sumber_dana" => $request->sumber_dana,
            "tahun_mulai" => $request->tahun_mulai,
            "tahun_selesai" => $request->tahun_selesai,
            "nominal" => $request->nominal,
        ]);
    }
    public static function getTunjanganKesejahteraanID($id_tunjangan)
    {
        return self::get(`/tunjangan/$id_tunjangan`);
    }

    public static function putTunjanganKesejahteraan($request)
    {
        return self::put(`/tunjangan/$request->id_tunjangan`, [
            "id_sdm" => $request->id_sdm,
            "id_jenis_tunjangan" => $request->id_jenis_tunjangan,
            "nama" => $request->nama,
            "instansi_pemberi" => $request->instansi_pemberi,
            "sumber_dana" => $request->sumber_dana,
            "tahun_mulai" => $request->tahun_mulai,
            "tahun_selesai" => $request->tahun_selesai,
            "nominal" => $request->nominal,
        ]);
    }

    public static function deleteTunjanganKesejahteraan($id_tunjangan)
    {
        return self::delete(`/tunjangan/$id_tunjangan`);
    }
}
