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
        Schema::create('structural_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sdm_id")->nullable()->constrained("human_resources")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId("structural_id")->nullable()->constrained("structures")->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('structural_positions');
    }
};
