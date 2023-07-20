<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DedicationsTable extends Migration
{
    public function up()
    {
        Schema::create('dedications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sdm_id');
            $table->string('role');
            $table->string('as');
            $table->string('theme');
            $table->string('title');
            $table->string('funding_source');
            $table->string('funding_amount');
            $table->string('proposal_file');
            $table->string('activity_schedule');
            $table->string('location');
            $table->json('participants');
            $table->text('target_activity_outputs');
            $table->text('public_media_publications');
            $table->text('scientific_publications');
            $table->timestamps();

            $table->foreign('sdm_id')->references('id')->on('human_resources')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dedications');
    }
}
