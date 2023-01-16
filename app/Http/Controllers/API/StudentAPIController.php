<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentDetail;
use App\Models\StudyProgram;
use App\Rules\ExcelRule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;

class StudentAPIController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'excel' => ['required', 'mimes:xlsx']
        ]);
        $excelFile = $request->file('excel');
        $imported = (new FastExcel())->import($excelFile);
        $program_studi = $this->prodi($imported);
        $students = $this->students($imported);
        return response()->json([
            'students' => $students,
            'program_studi' => $program_studi
        ], 200);
    }

    public function prodi($students)
    {
        $result = DB::transaction(function () use ($students) {
            $program_studi = [];
            foreach ($students as $student) {
                $program_studi[$student['Program Studi']] = true;
            }
            $program_studi = array_map('strtolower', array_keys($program_studi));
            $db_program_studi = array_map('strtolower', StudyProgram::all()->pluck('study_program')->toArray());
            $notExist = [];
            foreach ($program_studi as $ps) {
                if (!in_array(strtolower($ps), $db_program_studi)) array_push($notExist, ['study_program' => $ps]);
            }
            if (count($notExist) > 0) StudyProgram::insert($notExist);
            return true;
        });
        return $result;
    }

    public function students($students)
    {
        return DB::transaction(function () use ($students) {
            $list_prodi = StudyProgram::all()->toArray();
            $students = $students->map(function ($student) use ($list_prodi) {
                $prodi = strtolower($student['Program Studi']);
                $matchingProdi = collect($list_prodi)->filter(function ($item) use ($prodi) {
                    return $item['study_program'] == $prodi;
                });
                $prodi = '';
                $prodi_id = 0;
                if ($matchingProdi) {
                    $prodi_id = $matchingProdi->first()['id'];
                    $prodi = $matchingProdi->first()['study_program'];
                }
                return [
                    "student" => [
                        "nama_lengkap" => $student['Nama Lengkap'],
                        "gender" => $student['L/P'],
                        "tempat_tanggal_lahir" => $student['Tempat/Tanggal Lahir'],
                        "nim" => preg_replace('/[^\d]+/', '', $student['NIM']),
                        "password" => Hash::make(preg_replace('/[^\d]+/', '', $student['NIM'])),
                        "nik" => preg_replace('/[^\d]+/', '', $student['NIK']),
                        "program_studi_id" => $prodi_id,
                        "program_studi" => $prodi,
                        "sesi_kuliah" => $student['Sesi Kuliah'],
                        "periode_masuk" => $student['Periode Masuk'],
                        "angkatan" => $student['Angkatan'],
                        "no_tes" => $student['No. Tes'],
                        "status_masuk" => $student['Status Masuk'],
                        "jalur_masuk" => $student['Jalur Masuk'],
                        "tanggal_daftar" => $student['Tanggal Daftar'],
                        "gelombang_pendaftaran" => $student['Gelombang Pendaftaran'],
                        "status_akademik" => $student['Status Akademik'],
                        "status_mahasiswa" => $student['Status Mahasiswa'],
                        "agama" => $student['Agama'],
                        "status_nikah" => $student['Status Nikah'],
                        "kewarganegaraan" => $student['Kewarganegaraan'],
                        "status_domisili" => $student['Status Domisili'],
                        "alamat" => $student['Alamat'],
                        "kelurahan" => $student['Kelurahan'],
                        "kecamatan" => $student['Kecamatan'],
                        "kota_tinggal" => $student['Kota Tinggal'],
                        "kode_pos" => $student['Kode Pos'],
                        "negara" => $student['Negara'],
                        "no_telp" => $student['No. Telp'],
                        "no_hp" => $student['No. HP'],
                        "email" => $student['Email'],
                        "hubungan_biaya" => $student['Hubungan Biaya'],
                        "sumber_dana_beasiswa" => $student['Sumber Dana Beasiswa'],
                        "jumlah_saudara" => $student['Jumlah Saudara'],
                        "jumlah_saudara_laki" => $student['Jumlah Saudara Laki'],
                        "jumlah_saudara_perempuan" => $student['Jumlah Saudara Perempuan'],
                        "status_bekerja" => $student['Status Bekerja'],
                        "pekerjaan" => $student['Pekerjaan'],
                        "institusi_kantor" => $student['Institusi/Kantor'],
                        "jabatan" => $student['Jabatan'],
                        "alamat_institusi_kantor" => $student['Alamat Institusi/Kantor'],
                        "no_asuransi" => $student['No Asuransi'],
                        "hoby" => $student['Hoby'],
                        "tahu_kampus_ini_dari" => $student['Tahu kampus ini dari'],
                        "nim_lama" => $student['NIM Lama'],
                        "pt_asal" => $student['PT Asal'],
                        "tahun_masuk_pt_asal" => $student['Tahun Masuk PT Asal'],
                        "nama_ayah" => $student['Nama Ayah'],
                        "tanggal_lahir_ayah" => $student['Tanggal Lahir Ayah'],
                        "status_ayah" => $student['Status Ayah'],
                        "tanggal_meniggal_ayah" => $student['Tanggal Meniggal Ayah'],
                        "pendidikan_ayah" => $student['Pendidikan Ayah'],
                        "pendidikan_terakhir_ayah" => $student['Pendidikan Terakhir Ayah'],
                        "pekerjaan_ayah" => $student['Pekerjaan Ayah'],
                        "nama_ibu" => $student['Nama Ibu'],
                        "tanggal_lahir_ibu" => $student['Tanggal Lahir Ibu'],
                        "status_ibu" => $student['Status Ibu'],
                        "tanggal_meninggal_ibu" => $student['Tanggal Meninggal Ibu'],
                    ],
                    "detail" => [
                        "pendidikan_ibu" => $student['Pendidikan Ibu'],
                        "pendidikan_terakhir_ibu" => $student['Pendidikan Terakhir Ibu'],
                        "pekerjaan_ibu" => $student['Pekerjaan Ibu'],
                        "agama_orang_tua" => $student['Agama Orang Tua'],
                        "warga_negara_orang_tua" => $student['Warga Negara Orang Tua'],
                        "alamat_orang_tua" => $student['Alamat Orang Tua'],
                        "kota_orang_tua" => $student['Kota Orang Tua'],
                        "kode_pos_orang_tua" => $student['Kode Pos Orang Tua'],
                        "no_telp_orang_tua" => $student['No. Telp Orang Tua'],
                        "email_orang_tua" => $student['Email Orang Tua'],
                        "orang_tua_mampu" => $student['Orang Tua Mampu'],
                        "penghasilan_orang_tua" => $student['Penghasilan Orang Tua'],
                        "jumlah_tanggungan" => $student['Jumlah Tanggungan'],
                        "nama_wali" => $student['Nama Wali'],
                        "tanggal_lahir_wali" => $student['Tanggal Lahir Wali'],
                        "status_wali" => $student['Status Wali'],
                        "tanggal_meninggal_wali" => $student['Tanggal Meninggal Wali'],
                        "alamat_wali" => $student['Alamat Wali'],
                        "kota_wali" => $student['Kota Wali'],
                        "kode_pos_wali" => $student['Kode Pos Wali'],
                        "no_telp_wali" => $student['No Telp Wali'],
                        "email_wali" => $student['Email Wali'],
                        "pendidikan_wali" => $student['Pendidikan Wali'],
                        "pendidikan_terakhir_wali" => $student['Pendidikan Terakhir Wali'],
                        "pekerjaan_wali" => $student['Pekerjaan Wali'],
                        "tahun_daftar_smta" => $student['Tahun Daftar SMTA'],
                        "tahun_lulus_smta" => $student['Tahun Lulus SMTA'],
                        "jurusan_smta" => $student['Jurusan SMTA'],
                        "jenis_smta" => $student['Jenis SMTA'],
                        "nama_smta" => $student['Nama SMTA'],
                        "alamat_smta" => $student['Alamat SMTA'],
                        "nisn" => $student['NISN'],
                        "no_ijazah_smta" => $student['No Ijazah SMTA'],
                        "ijazah_smta" => $student['Ijazah SMTA'],
                        "tanggal_ijazah_smta" => $student['Tanggal Ijazah SMTA'],
                        "status_smta" => $student['Status SMTA'],
                        "akreditasi_smta" => $student['Akreditasi SMTA'],
                        "nilai_ujian_akhir_smta" => $student['Nilai Ujian AKhir SMTA'],
                        "nama_pt_s1" => $student['Nama PT (S1)'],
                        "status_pt_s1" => $student['Status PT (S1)'],
                        "fakultas_s1" => $student['Fakultas (S1)'],
                        "jurusan_program_studi_s1" => $student['Jurusan/Program Studi (S1)'],
                        "jalur_penyelesaian_studi_s1" => $student['Jalur Penyelesaian Studi (S1)'],
                        "ipk_yudisium_s1" => $student['IPK/Yudisium (S1)'],
                        "tanggal_lulus_s1" => $student['Tanggal Lulus (S1)'],
                        "beban_studi_sks_s1" => $student['Beban Studi (SKS) (S1)'],
                        "nama_pt_s2" => $student['Nama PT (S2)'],
                        "status_pt_s2" => $student['Status PT (S2)'],
                        "fakultas_s2" => $student['Fakultas (S2)'],
                        "jurusan_program_studi_s2" => $student['Jurusan/Program Studi (S2)'],
                        "jalur_penyelesaian_studi_s2" => $student['Jalur Penyelesaian Studi (S2)'],
                        "ipk_yudisium_s2" => $student['IPK/Yudisium (S2)'],
                        "tanggal_lulus_s2" => $student['Tanggal Lulus (S2)'],
                        "beban_studi_sks_s2" => $student['Beban Studi (SKS) (S2)']
                    ]
                ];
            });

            $list_students = Student::all()->pluck('nim')->toArray();
            $exist = array_filter(collect($students)->toArray(), function ($student) use ($list_students) {
                return in_array($student['student']['nim'], $list_students);
            });

            $notExist = array_filter(collect($students)->toArray(), function ($student) use ($list_students) {
                return !in_array($student['student']['nim'], $list_students);
            });
            $students = collect($notExist)->map(function ($student) {
                $uniqid = $this->genId($student);
                $student['student']['student_id'] = $uniqid;
                $student['detail']['student_id'] = $uniqid;
                Student::create($student['student']);
                return StudentDetail::create($student['detail']);
            });

            return [
                'exist' => count($exist),
                'not' => count($notExist)
            ];
        });
    }

    public function genId($student)
    {
        $nim = preg_replace('/\D/', '', $student['student']['nim']);
        $random = rand(100000000, 999999999);
        $random = str_pad($random, 9, "0", STR_PAD_LEFT);
        $uniqid = hash('md5', $nim . $random);
        return $nim . $uniqid;
    }

    public function index()
    {
        $prodi = request('prodi');
        $fakultas = request('fakultas');
        $angkatan = request('angkatan');

        $query = Student::query();
        $query->leftJoin('study_programs', 'students.program_studi_id', 'study_programs.id')
            ->leftJoin('faculties', 'study_programs.faculty_id', 'faculties.id');
        if ($prodi) {
            $query->where('study_programs.study_program', 'LIKE', "%$prodi%");
        }
        if ($fakultas) {
            $query->where('faculties.faculty', 'LIKE', "%$fakultas%");
        }
        if ($angkatan) {
            $query->where('students.angkatan', 'LIKE', "%$angkatan%");
        }
        // $query->leftJoin('student_details', function ($join) {
        //    $join->on('students.student_id', '=', 'student_details.student_id');
        //});
        $query->select(
            'students.student_id',
            'students.nama_lengkap',
            'students.gender',
            'students.tempat_tanggal_lahir',
            'students.nim',
            'students.password',
            'students.nik',
            'students.program_studi_id',
            'students.sesi_kuliah',
            'students.periode_masuk',
            'students.angkatan',
            'students.status_masuk',
            'students.jalur_masuk',
            'students.status_akademik',
            'students.status_mahasiswa',
            'students.agama',
            'students.status_nikah',
            'students.kewarganegaraan',
            'students.status_domisili',
            'students.alamat',
            'students.kelurahan',
            'students.kecamatan',
            'students.kota_tinggal',
            'students.kode_pos',
            'students.negara',
            'students.no_telp',
            'students.no_hp',
            'students.email',
            'study_programs.study_program',
            'faculties.faculty'
        ); //, 'student_details.*'
        $query->orderBy('students.angkatan', 'ASC');
        $students = $query->get();

        return response()->json([
            'data' => $students
        ], 200);
    }

    public function setPassword()
    {
        $angkatan = request('angkatan');
        if (!$angkatan) return response()->json(['message' => "set angkatan"], 422);
        // return DB::transaction(function () use ($angkatan) {
        $students = Student::where('angkatan', 'LIKE', "%$angkatan%")->whereNull('password')->get();
        foreach ($students as $student) {
            $student->password = Hash::make($student->nim);
            $student->save();
        }
        return response()->json(['message' => "berhasil " . $angkatan]);
        // });
    }

    public function validasiPassword()
    {
        $valid = array();
        $invalid = array();
        $angkatan = request('angkatan');
        $students = Student::where('angkatan', 'LIKE', "%$angkatan%")->whereNotNull('password')->limit(100)->get();
        foreach ($students as $student) {
            if (Hash::check($student->nim, $student->password)) {
                array_push($valid, $student->nim);
            } else {
                array_push($invalid, $student->nim);
            }
        }

        return response()->json([
            'valid' => $valid,
            'invalid' => $invalid
        ]);
    }
}
