<?php

namespace App\API;

/**
 * Penugasan
 */
trait Penugasan
{    
    /**
     * getPenugasan
     *
     * @param  mixed $id_sdm
     * @return void
     */
    public static function getPenugasan($id_sdm)
    {
        return self::get("/penugasan?id_sdm=$id_sdm");
    }
    
    /**
     * getPenugasanID
     *
     * @param  mixed $id_penugasan
     * @return void
     */
    public static function getPenugasanID($id_penugasan)
    {
        return self::get("/penugasan/$id_penugasan");
    }
}
