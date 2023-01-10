<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class StudentController extends Controller
{
    public function index()
    {
        return view('mahasiswa.admin.import');
    }

    public function import(Request $request)
    {
        $excelFile = $request->file('excel');
        $students = (new FastExcel())->import($excelFile);

        // $exel = $students->map(function ($student) {
        //     return
        //         [
        //             "nama_lengkap" => $student['Nama Lengkap'],
        //             "l_p" => $student['L/P'],
        //             "tempat_tanggal_lahir" => $student['Tempat/Tanggal Lahir'],
        //             "nim" => $student['NIM'],
        //             "nik" => $student['NIK'],
        //             "program_studi" => $student['Program Studi'],
        //             "sesi_kuliah" => $student['Sesi Kuliah'],
        //             "periode_masuk" => $student['Periode Masuk'],
        //             "angkatan" => $student['Angkatan'],
        //             "no_tes" => $student['No. Tes'],
        //             "status_masuk" => $student['Status Masuk'],
        //             "jalur_masuk" => $student['Jalur Masuk'],
        //             "tanggal_daftar" => $student['Tanggal Daftar'],
        //             "gelombang_pendaftaran" => $student['Gelombang Pendaftaran'],
        //             "status_akademik" => $student['Status Akademik'],
        //             "status_mahasiswa" => $student['Status Mahasiswa'],
        //             "agama" => $student['Agama'],
        //             "status_nikah" => $student['Status Nikah'],
        //             "kewarganegaraan" => $student['Kewarganegaraan'],
        //             "status_domisili" => $student['Status Domisili'],
        //             "alamat" => $student['Alamat'],
        //             "kelurahan" => $student['Kelurahan'],
        //             "kecamatan" => $student['Kecamatan'],
        //             "kota_tinggal" => $student['Kota Tinggal'],
        //             "kode_pos" => $student['Kode Pos'],
        //             "negara" => $student['Negara'],
        //             "no_telp" => $student['No. Telp'],
        //             "no_hp" => $student['No. HP'],
        //             "email" => $student['Email'],
        //             "hubungan_biaya" => $student['Hubungan Biaya'],
        //             "sumber_dana_beasiswa" => $student['Sumber Dana Beasiswa'],
        //             "jumlah_saudara" => $student['Jumlah Saudara'],
        //             "jumlah_saudara_laki" => $student['Jumlah Saudara Laki'],
        //             "jumlah_saudara_perempuan" => $student['Jumlah Saudara Perempuan'],
        //             "status_bekerja" => $student['Status Bekerja'],
        //             "pekerjaan" => $student['Pekerjaan'],
        //             "institusi_kantor" => $student['Institusi/Kantor'],
        //             "jabatan" => $student['Jabatan'],
        //             "alamat_institusi_kantor" => $student['Alamat Institusi/Kantor'],
        //             "no_asuransi" => $student['No Asuransi'],
        //             "hoby" => $student['Hoby'],
        //             "tahu_kampus_ini_dari" => $student['Tahu kampus ini dari'],
        //             "nim_lama" => $student['NIM Lama'],
        //             "pt_asal" => $student['PT Asal'],
        //             "tahun_masuk_pt_asal" => $student['Tahun Masuk PT Asal'],
        //             "nama_ayah" => $student['Nama Ayah'],
        //             "tanggal_lahir_ayah" => $student['Tanggal Lahir Ayah'],
        //             "status_ayah" => $student['Status Ayah'],
        //             "tanggal_meniggal_ayah" => $student['Tanggal Meniggal Ayah'],
        //             "pendidikan_ayah" => $student['Pendidikan Ayah'],
        //             "pendidikan_terakhir_ayah" => $student['Pendidikan Terakhir Ayah'],
        //             "pekerjaan_ayah" => $student['Pekerjaan Ayah'],
        //             "nama_ibu" => $student['Nama Ibu'],
        //             "tanggal_lahir_ibu" => $student['Tanggal Lahir Ibu'],
        //             "status_ibu" => $student['Status Ibu'],
        //             "tanggal_meninggal_ibu" => $student['Tanggal Meninggal Ibu'],
        //             "pendidikan_ibu" => $student['Pendidikan Ibu'],
        //             "pendidikan_terakhir_ibu" => $student['Pendidikan Terakhir Ibu'],
        //             "pekerjaan_ibu" => $student['Pekerjaan Ibu'],
        //             "agama_orang_tua" => $student['Agama Orang Tua'],
        //             "warga_negara_orang_tua" => $student['Warga Negara Orang Tua'],
        //             "alamat_orang_tua" => $student['Alamat Orang Tua'],
        //             "kota_orang_tua" => $student['Kota Orang Tua'],
        //             "kode_pos_orang_tua" => $student['Kode Pos Orang Tua'],
        //             "no_telp_orang_tua" => $student['No. Telp Orang Tua'],
        //             "email_orang_tua" => $student['Email Orang Tua'],
        //             "orang_tua_mampu" => $student['Orang Tua Mampu'],
        //             "penghasilan_orang_tua" => $student['Penghasilan Orang Tua'],
        //             "jumlah_tanggungan" => $student['Jumlah Tanggungan'],
        //             "nama_wali" => $student['Nama Wali'],
        //             "tanggal_lahir_wali" => $student['Tanggal Lahir Wali'],
        //             "status_wali" => $student['Status Wali'],
        //             "tanggal_meninggal_wali" => $student['Tanggal Meninggal Wali'],
        //             "alamat_wali" => $student['Alamat Wali'],
        //             "kota_wali" => $student['Kota Wali'],
        //             "kode_pos_wali" => $student['Kode Pos Wali'],
        //             "no_telp_wali" => $student['No Telp Wali'],
        //             "email_wali" => $student['Email Wali'],
        //             "pendidikan_wali" => $student['Pendidikan Wali'],
        //             "pendidikan_terakhir_wali" => $student['Pendidikan Terakhir Wali'],
        //             "pekerjaan_wali" => $student['Pekerjaan Wali'],
        //             "tahun_daftar_smta" => $student['Tahun Daftar SMTA'],
        //             "tahun_lulus_smta" => $student['Tahun Lulus SMTA'],
        //             "jurusan_smta" => $student['Jurusan SMTA'],
        //             "jenis_smta" => $student['Jenis SMTA'],
        //             "nama_smta" => $student['Nama SMTA'],
        //             "alamat_smta" => $student['Alamat SMTA'],
        //             "nisn" => $student['NISN'],
        //             "no_ijazah_smta" => $student['No Ijazah SMTA'],
        //             "ijazah_smta" => $student['Ijazah SMTA'],
        //             "tanggal_ijazah_smta" => $student['Tanggal Ijazah SMTA'],
        //             "status_smta" => $student['Status SMTA'],
        //             "akreditasi_smta" => $student['Akreditasi SMTA'],
        //             "nilai_ujian_akhir_smta" => $student['Nilai Ujian AKhir SMTA'],
        //             "nama_pt_s1" => $student['Nama PT (S1)'],
        //             "status_pt_s1" => $student['Status PT (S1)'],
        //             "fakultas_s1" => $student['Fakultas (S1)'],
        //             "jurusan_program_studi_s1" => $student['Jurusan/Program Studi (S1)'],
        //             "jalur_penyelesaian_studi_s1" => $student['Jalur Penyelesaian Studi (S1)'],
        //             "ipk_yudisium_s1" => $student['IPK/Yudisium (S1)'],
        //             "tanggal_lulus_s1" => $student['Tanggal Lulus (S1)'],
        //             "beban_studi_sks_s1" => $student['Beban Studi (SKS) (S1)'],
        //             "nama_pt_s2" => $student['Nama PT (S2)'],
        //             "status_pt_s2" => $student['Status PT (S2)'],
        //             "fakultas_s2" => $student['Fakultas (S2)'],
        //             "jurusan_program_studi_s2" => $student['Jurusan/Program Studi (S2)'],
        //             "jalur_penyelesaian_studi_s2" => $student['Jalur Penyelesaian Studi (S2)'],
        //             "ipk_yudisium_s2" => $student['IPK/Yudisium (S2)'],
        //             "tanggal_lulus_s2" => $student['Tanggal Lulus (S2)'],
        //             "beban_studi_sks_s2" => $student['Beban Studi (SKS) (S2)']
        //         ];
        // });

        $program_studi = $this->prodi($students);
        return response()->json($program_studi);
    }

    public function prodi($students)
    {
        $program_studi = [];
        foreach ($students as $student) {
            $program_studi[Str::lower($student['Program Studi'])] = true;
        }
        $program_studi = array_keys($program_studi);
        // $program_studi_db = StudyProgram::whereIn('study_program', $program_studi)->get();
        // if ($program_studi_db->count() != count($program_studi)) {
        //     $program_studi_tidak_ada = array_diff($program_studi, $program_studi_db->pluck('nama')->toArray());
        //     StudyProgram::insert($program_studi_tidak_ada);
        // }
        return $program_studi;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Student $student)
    {
        //
    }

    public function edit(Student $student)
    {
        //
    }

    public function update(Request $request, Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        //
    }
}
