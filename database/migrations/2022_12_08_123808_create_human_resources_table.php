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
        Schema::create('human_resources', function (Blueprint $table) {
            $table->id();
            $table->string('sdm_id', 300)->nullable();
            $table->string('sdm_name', 300)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('nidn', 300)->nullable();
            $table->string('nip', 300)->nullable();
            $table->string('active_status_name', 300)->nullable();
            $table->string('employee_status', 300)->nullable();
            $table->string('sdm_type', 300)->nullable();
            $table->boolean('is_sister_exist')->nullable();

            $table->foreignId("faculty_id")->nullable()->constrained("faculties")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId("study_program_id")->nullable()->constrained("study_programs")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId("structure_id")->nullable()->constrained("structures")->cascadeOnUpdate()->nullOnDelete();

            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('human_resources');
    }
};
