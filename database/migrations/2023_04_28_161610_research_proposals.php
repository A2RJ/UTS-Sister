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
        Schema::create('research_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sdm_id")
                ->nullable()
                ->constrained("human_resources")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('proposal_title');
            $table->string('grant_scheme');
            $table->string('target_outcomes');
            $table->string('proposal_file');
            $table->enum('application_status', ['Sedang dalam ajuan', 'Lolos pendanaan']);
            $table->string('contract_period')->nullable();
            $table->string('funding_amount')->nullable();
            $table->boolean('verification')->default(false);
            $table->string('assignment_letter_link')->nullable();
            $table->string('publication_title');
            $table->enum('author_status', [1, 2, 3, 'correspondence author']);
            $table->string('journal_name');
            $table->year('publication_year');
            $table->string('volume_number');
            $table->string('publication_date_year');
            $table->string('publisher');
            $table->enum('journal_accreditation_status', ['International', 'Nationally accredited', 'Internal']);
            $table->string('journal_publication_link');
            $table->string('journal_pdf_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ResearchProposals');
    }
};
