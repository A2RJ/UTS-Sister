<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->nullable()->constrained("students")->cascadeOnUpdate()->nullOnDelete();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pendidikan_terakhir_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('agama_orang_tua')->nullable();
            $table->string('warga_negara_orang_tua')->nullable();
            $table->string('alamat_orang_tua')->nullable();
            $table->string('kota_orang_tua')->nullable();
            $table->string('kode_pos_orang_tua')->nullable();
            $table->string('no_telp_orang_tua')->nullable();
            $table->string('email_orang_tua')->nullable();
            $table->string('orang_tua_mampu')->nullable();
            $table->string('penghasilan_orang_tua')->nullable();
            $table->string('jumlah_tanggungan')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('tanggal_lahir_wali')->nullable();
            $table->string('status_wali')->nullable();
            $table->string('tanggal_meninggal_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('kota_wali')->nullable();
            $table->string('kode_pos_wali')->nullable();
            $table->string('no_telp_wali')->nullable();
            $table->string('email_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('pendidikan_terakhir_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('tahun_daftar_smta')->nullable();
            $table->string('tahun_lulus_smta')->nullable();
            $table->string('jurusan_smta')->nullable();
            $table->string('jenis_smta')->nullable();
            $table->string('nama_smta')->nullable();
            $table->string('alamat_smta')->nullable();
            $table->string('nisn')->nullable();
            $table->string('no_ijazah_smta')->nullable();
            $table->string('ijazah_smta')->nullable();
            $table->string('tanggal_ijazah_smta')->nullable();
            $table->string('status_smta')->nullable();
            $table->string('akreditasi_smta')->nullable();
            $table->string('nilai_ujian_akhir_smta')->nullable();
            $table->string('nama_pt_s1')->nullable();
            $table->string('status_pt_s1')->nullable();
            $table->string('fakultas_s1')->nullable();
            $table->string('jurusan_program_studi_s1')->nullable();
            $table->string('jalur_penyelesaian_studi_s1')->nullable();
            $table->string('ipk_yudisium_s1')->nullable();
            $table->string('tanggal_lulus_s1')->nullable();
            $table->string('beban_studi_sks_s1')->nullable();
            $table->string('nama_pt_s2')->nullable();
            $table->string('status_pt_s2')->nullable();
            $table->string('fakultas_s2')->nullable();
            $table->string('jurusan_program_studi_s2')->nullable();
            $table->string('jalur_penyelesaian_studi_s2')->nullable();
            $table->string('ipk_yudisium_s2')->nullable();
            $table->string('tanggal_lulus_s2')->nullable();
            $table->string('beban_studi_sks_s2')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_details');
    }
};
