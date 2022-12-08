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
            $table->comment('');
            $table->integer('id', true);
            $table->foreignId("subject_id")->nullable()->constrained("subjects")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId("subject_class_id")->nullable()->constrained("subjects_class")->cascadeOnUpdate()->nullOnDelete();
            $table->date('start')->useCurrent();
            $table->date('end')->useCurrent();
            $table->text('filename_start');
            $table->text('filename_end');
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
