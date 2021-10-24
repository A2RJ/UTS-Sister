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
    public static function getRefAgama()
    {
        return self::get('/referensi/agama');
    }
    
    /**
     * getBidangStudi
     *
     * @return void
     */
    public static function getRefBidangStudi()
    {
        return self::get('/referensi/bidang_studi');
    }
    
    /**
     * getBidangUsaha
     *
     * @return void
     */
    public static function getRefBidangUsaha()
    {
        return self::get('/referensi/bidang_usaha');
    }
    
    /**
     * getGelarAkademik
     *
     * @return void
     */
    public static function getRefGelarAkademik()
    {
        return self::get('/referensi/gelar_akademik');
    }
    
    /**
     * getGolonganPangkat
     *
     * @return void
     */
    public static function getRefGolonganPangkat()
    {
        return self::get('/referensi/golongan_pangkat');
    }
    
    /**
     * getIkatanKerja
     *
     * @return void
     */
    public static function getRefIkatanKerja()
    {
        return self::get('/referensi/ikatan_kerja');
    }
    
    /**
     * getJabatanFungsional
     *
     * @return void
     */
    public static function getRefJabatanFungsional()
    {
        return self::get('/referensi/jabatan_fungsional');
    }

    public static function getRefJabatanNegara()
    {
        return self::get('/referensi/jabatan_negara');
    }

    public static function getRefJabatanTugasTambahan()
    {
        return self::get('/referensi/jabatan_tugas_tambahan');
    }

    public static function getRefJenisBeasiswa()
    {
        return self::get('/referensi/jenis_beasiswa');
    }

    public static function getRefJenisDiklat()
    {
        return self::get('/referensi/jenis_diklat');
    }

    public static function getRefJenisDokumen()
    {
        return self::get('/referensi/jenis_dokumen');
    }

    public static function getRefJenisKeluar()
    {
        return self::get('/referensi/jenis_keluar');
    }

    public static function getRefJenisKepanitiaan()
    {
        return self::get('/referensi/jenis_kepanitiaan');
    }

    public static function getRefJenisKesejahteraan()
    {
        return self::get('/referensi/jenis_kesejahteraan');
    }

    public static function getRefJenisPekerjaan()
    {
        return self::get('/referensi/jenis_pekerjaan');
    }

    public static function getRefJenisPenghargaan()
    {
        return self::get('/referensi/jenis_penghargaan');
    }

    public static function getRefJenisPublikasi()
    {
        return self::get('/referensi/jenis_publikasi');
    }

    public static function getRefJenisTes()
    {
        return self::get('/referensi/jenis_tes');
    }

    public static function getRefJenisTunjangan()
    {
        return self::get('/referensi/jenis_tunjangan');
    }

    public static function getRefKategoriCapaianLuaran()
    {
        return self::get('/referensi/kategori_capaian_luaran');
    }

    public static function getRefKategoriKegiatan($tipe, $menu)
    {
        return self::get('/referensi/kategori_kegiatan', [
            'tipe' => $tipe,
            'menu' => $menu
        ]);
    }

    public static function getRefKelompokBidang($iptek)
    {
        return self::get('/referensi/kelompok_bidang', [
            'iptek' => $iptek
        ]);
    }

    public static function getRefMahasiswaPDDIKTI($id_perguruan_tinggi, $id_program_studi, $keyword)
    {
        return self::get('/referensi/mahasiswa_pddikti', [
            'id_perguruan_tinggi' => $id_perguruan_tinggi,
            'id_program_studi' => $id_program_studi,
            'keyword' => $keyword,
        ]);
    }

    public static function getRefMediaPublikasi($nama)
    {
        return self::get('/referensi/media_publikasi', [
            'nama' => $nama
        ]);
    }

    public static function getRefNegara()
    {
        return self::get('/referensi/negara');
    }

    public static function getRefPT()
    {
        return self::get('/referensi/perguruan_tinggi');
    }

    public static function getRefProfilePT()
    {
        return self::get('/referensi/profil_pt');
    }

    public static function getRefSDM($nama, $nidn, $nip)
    {
        return self::get('/referensi/sdm', [
            'nama' => $nama,
            'nidn' => $nidn,
            'nip' => $nip
        ]);
    }

    public static function getRefSemester()
    {
        return self::get('/referensi/semester');
    }

    public static function getRefStatuskepegawaian()
    {
        return self::get('/referensi/status_kepegawaian');
    }

    public static function getRefSumberGaji()
    {
        return self::get('/referensi/sumber_gaji');
    }

    public static function getRefTingkatPenghargaan()
    {
        return self::get('/referensi/tingkat_penghargaan');
    }

    public static function getRefUnitKerja($id_perguruan_tinggi)
    {
        return self::get('/referensi/unit_kerja', [
            'id_perguruan_tinggi' => $id_perguruan_tinggi
        ]);
    }

    public static function getRefWilayah($id_level_wilayah)
    {
        return self::get('/referensi/wilayah', [
            'id_level_wilayah' => $id_level_wilayah
        ]);
    }
}
