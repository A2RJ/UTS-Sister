<?php

namespace App\API;

/**
 * Pengajaran
 */
trait Pengajaran
{
    public static function getPengajaran($id_sdm, $id_semester)    {
        return self::get("/pengajaran?id_sdm=$id_sdm&id_semester=$id_semester");
    }

    public static function getPengajaranID($id_Pengajaran)
    {
        return self::get("/pengajaran/$id_Pengajaran");
    }

    public static function getPengajaranBidang($id_Pengajaran)
    {
        return self::get("/pengajaran/$id_Pengajaran/bidang_ilmu");
    }

    public static function putPengajaran($request)
    {
        return self::put("/pengajaran/$request->id_Pengajaran", [
            "dokumen" => $request->id_kelompok_bidang
        ]);
    }
}
