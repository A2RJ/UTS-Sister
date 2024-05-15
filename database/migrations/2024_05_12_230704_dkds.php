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
        Schema::create('bkds', function (Blueprint $table) {
            $table->id();
            $table->string('nidn');
            $table->string('period');
            $table->string('lecture_name');
            $table->string('status');
            $table->string('jafung');
            $table->string('ab');
            $table->string('c');
            $table->string('d');
            $table->string('e');
            $table->string('total');
            $table->string('summary');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkds');
    }
};
