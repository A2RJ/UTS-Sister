<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap')->nullable();
            $table->string('gender')->nullable();
            $table->string('tempat_tanggal_lahir')->nullable();
            $table->string('nim')->nullable();
            $table->string('nik')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('sesi_kuliah')->nullable();
            $table->string('periode_masuk')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('no_tes')->nullable();
            $table->string('status_masuk')->nullable();
            $table->string('jalur_masuk')->nullable();
            $table->string('tanggal_daftar')->nullable();
            $table->string('gelombang_pendaftaran')->nullable();
            $table->string('status_akademik')->nullable();
            $table->string('status_mahasiswa')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_nikah')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('status_domisili')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_tinggal')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('negara')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('hubungan_biaya')->nullable();
            $table->string('sumber_dana_beasiswa')->nullable();
            $table->string('jumlah_saudara')->nullable();
            $table->string('jumlah_saudara_laki')->nullable();
            $table->string('jumlah_saudara_perempuan')->nullable();
            $table->string('status_bekerja')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('institusi_kantor')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('alamat_institusi_kantor')->nullable();
            $table->string('no_asuransi')->nullable();
            $table->string('hoby')->nullable();
            $table->string('tahu_kampus_ini_dari')->nullable();
            $table->string('nim_lama')->nullable();
            $table->string('pt_asal')->nullable();
            $table->string('tahun_masuk_pt_asal')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('tanggal_lahir_ayah')->nullable();
            $table->string('status_ayah')->nullable();
            $table->string('tanggal_meniggal_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_terakhir_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('tanggal_lahir_ibu')->nullable();
            $table->string('status_ibu')->nullable();
            $table->string('tanggal_meninggal_ibu')->nullable();
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
        Schema::dropIfExists('students');
    }
};
