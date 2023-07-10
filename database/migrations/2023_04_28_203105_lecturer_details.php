<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lecturer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sdm_id")
                ->nullable()
                ->constrained("human_resources")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('faculty_id')
                ->constrained('faculties')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('study_program_id')
                ->constrained('study_programs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('expertise');
            $table->string('theme');
            $table->string('other_theme')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer_details');
    }
};
