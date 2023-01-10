<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    public $fillable = [
        "student_id",
        'pendidikan_ibu',
        'pendidikan_terakhir_ibu',
        'pekerjaan_ibu',
        'agama_orang_tua',
        'warga_negara_orang_tua',
        'alamat_orang_tua',
        'kota_orang_tua',
        'kode_pos_orang_tua',
        'no_telp_orang_tua',
        'email_orang_tua',
        'orang_tua_mampu',
        'penghasilan_orang_tua',
        'jumlah_tanggungan',
        'nama_wali',
        'tanggal_lahir_wali',
        'status_wali',
        'tanggal_meninggal_wali',
        'alamat_wali',
        'kota_wali',
        'kode_pos_wali',
        'no_telp_wali',
        'email_wali',
        'pendidikan_wali',
        'pendidikan_terakhir_wali',
        'pekerjaan_wali',
        'tahun_daftar_smta',
        'tahun_lulus_smta',
        'jurusan_smta',
        'jenis_smta',
        'nama_smta',
        'alamat_smta',
        'nisn',
        'no_ijazah_smta',
        'ijazah_smta',
        'tanggal_ijazah_smta',
        'status_smta',
        'akreditasi_smta',
        'nilai_ujian_akhir_smta',
        'nama_pt_s1',
        'status_pt_s1',
        'fakultas_s1',
        'jurusan_program_studi_s1',
        'jalur_penyelesaian_studi_s1',
        'ipk_yudisium_s1',
        'tanggal_lulus_s1',
        'beban_studi_sks_s1',
        'nama_pt_s2',
        'status_pt_s2',
        'fakultas_s2',
        'jurusan_program_studi_s2',
        'jalur_penyelesaian_studi_s2',
        'ipk_yudisium_s2',
        'tanggal_lulus_s2',
        'beban_studi_sks_s2',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'student_id', 'id');
    }
}
