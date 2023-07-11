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
        Schema::create('off_campus_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sdm_id")
                ->nullable()
                ->constrained("human_resources")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('title');
            $table->string('location');
            $table->string('performance_certificate');
            $table->enum('budget_source', ['mandiri', 'universitas', 'instansi tempat kerjasama', 'kerjasama']);
            $table->date('execution_date');
            $table->string('funding_amount');
            $table->string('number_of_students');
            $table->json('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('off_campus_activities');
    }
};
