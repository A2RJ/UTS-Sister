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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("subject_id")->nullable()->constrained("subjects")->cascadeOnUpdate()->nullOnDelete();
            $table->string("meeting_name");
            $table->string("date")->nullable();
            $table->string('meeting_start')->nullable();
            $table->string('meeting_end')->nullable();
            $table->text('file_start')->nullable();
            $table->text('file_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
};
