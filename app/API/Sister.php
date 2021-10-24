<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;

class Sister extends Model
{
   use Routes,
      Referensi,
      Dokumen,
      Kolaborator,
      DataPokok,
      Inpassing,
      JabatanFungsional,
      Kepangkatan,
      Penugasan,
      Pengajaran,
      BimbinganMahasiswa,
      PengujianMahasiswa,
      Datasering,
      OrasiIlmiah,
      BahanAjar,
      BimbinganDosen,
      TugasTambahan,
      Penelitian,
      Publikasi;
   
   /**
    * index
    *
    * @return void
    */
   public static function index()
   {
      return json_encode([
         "vendor" => env("VENDOR"),
         "programmer" => env("PROG"),
         "readMe" => env("README")
      ]);
   }
}
