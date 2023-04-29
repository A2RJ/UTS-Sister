<?php

namespace App\Models\Wr3;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'sdm_id',
        'proposal_title',
        'grant_scheme',
        'target_outcomes',
        'proposal_file',
        'application_status',
        'contract_period',
        'funding_amount',
        'verification',
        'assignment_letter_link',
        'publication_title',
        'author_status',
        'journal_name',
        'publication_year',
        'volume_number',
        'publication_date_year',
        'publisher',
        'journal_accreditation_status',
        'journal_publication_link',
        'journal_pdf_file'
    ];

    public function humanResource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }
}
