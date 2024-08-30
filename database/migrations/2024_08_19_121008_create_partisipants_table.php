<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId("human_resource_id")
                ->nullable()
                ->constrained("human_resources")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId("research_proposal_id")
                ->nullable()
                ->constrained("research_proposals")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('role');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
