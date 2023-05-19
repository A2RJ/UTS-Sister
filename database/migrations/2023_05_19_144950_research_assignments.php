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
        Schema::create('research_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sdm_id")
                ->nullable()
                ->constrained("human_resources")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('role');
            $table->string('activity');
            $table->string('as');
            $table->string('theme');
            $table->date('date');
            $table->string('organizer');
            $table->string('location');
            $table->json('table');
            $table->integer('number')->nullable();
            $table->string('month')->nullable();
            $table->integer('year')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_assignments');
    }
};
