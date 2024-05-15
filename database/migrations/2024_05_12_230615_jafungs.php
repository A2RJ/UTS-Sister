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
        Schema::create('jafungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("human_resource_id")
                ->nullable()
                ->constrained("human_resources")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->enum('jafung', ['asisten ahli 150', 'lektor 200', 'lektor 300', 'lektor kepala 400', 'lektor kepala 550', 'lektor kepala 700', 'profesor 800', 'profesor 1050']);
            $table->string('sk_number');
            $table->string('start_from');
            $table->string('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jafungs');
    }
};
