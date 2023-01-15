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
        Schema::table('human_resources', function (Blueprint $table) {
            $table->foreignId("program_studi_id")->nullable()->constrained("study_programs")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('human_resources', function (Blueprint $table) {
            $table->dropColumn('program_studi_id');
        });
    }
};
