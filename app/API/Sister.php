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
      Publikasi,
      KekayanIntelektual,
      Pengabdian,
      Pembicara,
      JabatanStruktural,
      AnggotaProfesi,
      Jurnal,
      Penghargaan,
      Scientist,
      PenunjangLain,
      PendidikanFormal,
      Diklat,
      RiwayatPekerjaan,
      SertifikasiProfesi,
      SertifikasiDosen,
      Tes,
      Beasiswa,
      Kesejahteraan,
      Tunjangan;
   
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
