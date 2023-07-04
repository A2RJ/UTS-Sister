<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StudentDetail
 *
 * @property int $id
 * @property string $student_id
 * @property string|null $pendidikan_ibu
 * @property string|null $pendidikan_terakhir_ibu
 * @property string|null $pekerjaan_ibu
 * @property string|null $agama_orang_tua
 * @property string|null $warga_negara_orang_tua
 * @property string|null $alamat_orang_tua
 * @property string|null $kota_orang_tua
 * @property string|null $kode_pos_orang_tua
 * @property string|null $no_telp_orang_tua
 * @property string|null $email_orang_tua
 * @property string|null $orang_tua_mampu
 * @property string|null $penghasilan_orang_tua
 * @property string|null $jumlah_tanggungan
 * @property string|null $nama_wali
 * @property string|null $tanggal_lahir_wali
 * @property string|null $status_wali
 * @property string|null $tanggal_meninggal_wali
 * @property string|null $alamat_wali
 * @property string|null $kota_wali
 * @property string|null $kode_pos_wali
 * @property string|null $no_telp_wali
 * @property string|null $email_wali
 * @property string|null $pendidikan_wali
 * @property string|null $pendidikan_terakhir_wali
 * @property string|null $pekerjaan_wali
 * @property string|null $tahun_daftar_smta
 * @property string|null $tahun_lulus_smta
 * @property string|null $jurusan_smta
 * @property string|null $jenis_smta
 * @property string|null $nama_smta
 * @property string|null $alamat_smta
 * @property string|null $nisn
 * @property string|null $no_ijazah_smta
 * @property string|null $ijazah_smta
 * @property string|null $tanggal_ijazah_smta
 * @property string|null $status_smta
 * @property string|null $akreditasi_smta
 * @property string|null $nilai_ujian_akhir_smta
 * @property string|null $nama_pt_s1
 * @property string|null $status_pt_s1
 * @property string|null $fakultas_s1
 * @property string|null $jurusan_program_studi_s1
 * @property string|null $jalur_penyelesaian_studi_s1
 * @property string|null $ipk_yudisium_s1
 * @property string|null $tanggal_lulus_s1
 * @property string|null $beban_studi_sks_s1
 * @property string|null $nama_pt_s2
 * @property string|null $status_pt_s2
 * @property string|null $fakultas_s2
 * @property string|null $jurusan_program_studi_s2
 * @property string|null $jalur_penyelesaian_studi_s2
 * @property string|null $ipk_yudisium_s2
 * @property string|null $tanggal_lulus_s2
 * @property string|null $beban_studi_sks_s2
 * @property string $created_at
 * @property string $updated_at
 * @property-read \App\Models\Student|null $student
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAgamaOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAkreditasiSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAlamatOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAlamatSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAlamatWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereBebanStudiSksS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereBebanStudiSksS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereEmailOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereEmailWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereFakultasS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereFakultasS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereIjazahSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereIpkYudisiumS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereIpkYudisiumS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJalurPenyelesaianStudiS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJalurPenyelesaianStudiS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJenisSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJumlahTanggungan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJurusanProgramStudiS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJurusanProgramStudiS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJurusanSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereKodePosOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereKodePosWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereKotaOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereKotaWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNamaPtS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNamaPtS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNamaSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNamaWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNilaiUjianAkhirSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNisn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNoIjazahSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNoTelpOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNoTelpWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereOrangTuaMampu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePekerjaanIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePekerjaanWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePendidikanIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePendidikanTerakhirIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePendidikanTerakhirWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePendidikanWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePenghasilanOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStatusPtS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStatusPtS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStatusSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStatusWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTahunDaftarSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTahunLulusSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalIjazahSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalLahirWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalLulusS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalLulusS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalMeninggalWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereWargaNegaraOrangTua($value)
 * @mixin \Eloquent
 */
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

    public $timestamps = false;

    public function student()
    {
        return $this->hasOne(Student::class, 'student_id', 'id');
    }
}
