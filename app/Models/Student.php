<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $fillable = [
        'student_id',
        'nama_lengkap',
        'gender',
        'tempat_tanggal_lahir',
        'nim',
        'password',
        'nik',
        'program_studi_id',
        'sesi_kuliah',
        'periode_masuk',
        'angkatan',
        'no_tes',
        'status_masuk',
        'jalur_masuk',
        'tanggal_daftar',
        'gelombang_pendaftaran',
        'status_akademik',
        'status_mahasiswa',
        'agama',
        'status_nikah',
        'kewarganegaraan',
        'status_domisili',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota_tinggal',
        'kode_pos',
        'negara',
        'no_telp',
        'no_hp',
        'email',
        'hubungan_biaya',
        'sumber_dana_beasiswa',
        'jumlah_saudara',
        'jumlah_saudara_laki',
        'jumlah_saudara_perempuan',
        'status_bekerja',
        'pekerjaan',
        'institusi_kantor',
        'jabatan',
        'alamat_institusi_kantor',
        'no_asuransi',
        'hoby',
        'tahu_kampus_ini_dari',
        'nim_lama',
        'pt_asal',
        'tahun_masuk_pt_asal',
        'nama_ayah',
        'tanggal_lahir_ayah',
        'status_ayah',
        'tanggal_meniggal_ayah',
        'pendidikan_ayah',
        'pendidikan_terakhir_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'status_ibu',
        'tanggal_meninggal_ibu',
    ];

    public $timestamps = false;

    public function detail()
    {
        return $this->hasOne(StudentDetail::class, 'student_id', 'student_id');
    }
}
