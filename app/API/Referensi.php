<?php

namespace App\API;
/**
 * Referensi
 */
trait Referensi
{    
    /**
     * getAgama
     * Fungsi untuk mengambil agama
     * @Referensi http://sister.uts.ac.id/ws.php/1.0#get-/referensi/agama
     * @return void
     */
    public static function getAgama()
    {
        return self::get('/referensi/agama');
    }
    
    /**
     * getBidangStudi
     *
     * @return void
     */
    public static function getBidangStudi()
    {
        return self::get('/referensi/bidang_studi');
    }
    
    /**
     * getBidangUsaha
     *
     * @return void
     */
    public static function getBidangUsaha()
    {
        return self::get('/referensi/bidang_usaha');
    }
    
    /**
     * getGelarAkademik
     *
     * @return void
     */
    public static function getGelarAkademik()
    {
        return self::get('/referensi/gelar_akademik');
    }
    
    /**
     * getGolonganPangkat
     *
     * @return void
     */
    public static function getGolonganPangkat()
    {
        return self::get('/referensi/golongan_pangkat');
    }
    
    /**
     * getIkatanKerja
     *
     * @return void
     */
    public static function getIkatanKerja()
    {
        return self::get('/referensi/ikatan_kerja');
    }
    
    /**
     * getJabatanFungsional
     *
     * @return void
     */
    public static function getJabatanFungsional()
    {
        return self::get('/referensi/jabatan_fungsional');
    }

    public static function getJabatanNegara()
    {
        return self::get('/referensi/jabatan_negara');
    }

    public static function getJabatanTugasTambahan()
    {
        return self::get('/referensi/jabatan_tugas_tambahan');
    }

    public static function getJenisBeasiswa()
    {
        return self::get('/referensi/jenis_beasiswa');
    }

    public static function getJenisDiklat()
    {
        return self::get('/referensi/jenis_diklat');
    }

    public static function getJenisDokumen()
    {
        return self::get('/referensi/jenis_dokumen');
    }

    public static function getJenisKeluar()
    {
        return self::get('/referensi/jenis_keluar');
    }

    public static function getJenisKepanitiaan()
    {
        return self::get('/referensi/jenis_kepanitiaan');
    }

    public static function getJenisKesejahteraan()
    {
        return self::get('/referensi/jenis_kesejahteraan');
    }

    public static function getJenisPekerjaan()
    {
        return self::get('/referensi/jenis_pekerjaan');
    }

    public static function getJenisPenghargaan()
    {
        return self::get('/referensi/jenis_penghargaan');
    }

    public static function getJenisPublikasi()
    {
        return self::get('/referensi/jenis_publikasi');
    }

    public static function getJenisTes()
    {
        return self::get('/referensi/jenis_tes');
    }

    public static function getJenisTunjangan()
    {
        return self::get('/referensi/jenis_tunjangan');
    }

    public static function getKategoriCapaianLuaran()
    {
        return self::get('/referensi/kategori_capaian_luaran');
    }

    public static function getKategoriKegiatan($tipe, $menu)
    {
        return self::get('/referensi/kategori_kegiatan', [
            'tipe' => $tipe,
            'menu' => $menu
        ]);
    }

    public static function getKelompokBidang($iptek)
    {
        return self::get('/referensi/kelompok_bidang', [
            'iptek' => $iptek
        ]);
    }

    public static function getMahasiswaPDDIKTI($id_perguruan_tinggi, $id_program_studi, $keyword)
    {
        return self::get('/referensi/mahasiswa_pddikti', [
            'id_perguruan_tinggi' => $id_perguruan_tinggi,
            'id_program_studi' => $id_program_studi,
            'keyword' => $keyword,
        ]);
    }

    public static function getMediaPublikasi($nama)
    {
        return self::get('/referensi/media_publikasi', [
            'nama' => $nama
        ]);
    }

    public static function getNegara()
    {
        return self::get('/referensi/negara');
    }

    public static function getPT()
    {
        return self::get('/referensi/perguruan_tinggi');
    }

    public static function getProfilePT()
    {
        return self::get('/referensi/profil_pt');
    }

    public static function getSDM($nama, $nidn, $nip)
    {
        return self::get('/referensi/sdm', [
            'nama' => $nama,
            'nidn' => $nidn,
            'nip' => $nip
        ]);
    }

    public static function getSemester()
    {
        return self::get('/referensi/semester');
    }

    public static function getStatuskepegawaian()
    {
        return self::get('/referensi/status_kepegawaian');
    }

    public static function getSumberGaji()
    {
        return self::get('/referensi/sumber_gaji');
    }

    public static function getTingkatPenghargaan()
    {
        return self::get('/referensi/tingkat_penghargaan');
    }

    public static function getUnitKerja($id_perguruan_tinggi)
    {
        return self::get('/referensi/unit_kerja', [
            'id_perguruan_tinggi' => $id_perguruan_tinggi
        ]);
    }

    public static function getWilayah($id_level_wilayah)
    {
        return self::get('/referensi/wilayah', [
            'id_level_wilayah' => $id_level_wilayah
        ]);
    }
}
