<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('id_sdm', 300)->nullable();
            $table->string('nama_sdm', 300)->nullable();
            $table->string('nidn', 300)->nullable();
            $table->string('nip', 300)->nullable();
            $table->string('nama_status_aktif', 300)->nullable();
            $table->string('nama_status_pegawai', 300)->nullable();
            $table->string('jenis_sdm', 300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sdm');
    }
}
