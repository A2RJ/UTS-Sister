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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sdm_id")->nullable()->constrained("human_resources")->cascadeOnUpdate()->nullOnDelete();
            $table->string('latitude_in', 10, 8)->default(0);
            $table->string('longitude_in', 11, 8)->default(0);
            $table->string('check_in_time');
            $table->string('check_out_time')->nullable();
            $table->string('latitude_out', 10, 8)->nullable();
            $table->string('longitude_out', 11, 8)->nullable();
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
        Schema::dropIfExists('presences');
    }
};
