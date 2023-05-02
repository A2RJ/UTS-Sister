<?php

namespace App\Models\Wr3;

use App\Models\HumanResource;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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

    public function humanResource(): BelongsTo
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }

    public function verification(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value ? 'Terverifikasi' : 'Tidak terverifikasi'
        );
    }
}
