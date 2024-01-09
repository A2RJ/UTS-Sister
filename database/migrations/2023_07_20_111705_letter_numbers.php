<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('letter_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id')->nullable();
            $table->unsignedBigInteger('dedication_id')->nullable();
            $table->string('number')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->timestamps();

            $table->foreign('proposal_id')->references('id')->on('research_proposals')->onDelete('cascade');
            $table->foreign('dedication_id')->references('id')->on('dedications')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('letter_numbers');
    }
};
