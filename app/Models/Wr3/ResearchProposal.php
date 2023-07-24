<?php

namespace App\Models\Wr3;

use App\Models\HumanResource;
use App\Traits\Model\UtilsFunction;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Wr3\ResearchProposal
 *
 * @property int $id
 * @property int|null $sdm_id
 * @property string $proposal_title
 * @property string $grant_scheme
 * @property string $target_outcomes
 * @property string $proposal_file
 * @property string $application_status
 * @property string|null $contract_period
 * @property string|null $funding_amount
 * @property int $verification
 * @property string|null $publication_title
 * @property string|null $author_status
 * @property string|null $journal_name
 * @property string|null $publication_year
 * @property string|null $volume_number
 * @property string|null $publication_date_year
 * @property string|null $publisher
 * @property string|null $journal_accreditation_status
 * @property string|null $journal_publication_link
 * @property string|null $journal_pdf_file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read HumanResource|null $humanResource
 * @property-read \App\Models\Wr3\LetterNumber|null $letterNumber
 * @method static Builder|ResearchProposal export(?array $columns = null)
 * @method static \Database\Factories\Wr3\ResearchProposalFactory factory($count = null, $state = [])
 * @method static Builder|ResearchProposal newModelQuery()
 * @method static Builder|ResearchProposal newQuery()
 * @method static Builder|ResearchProposal query()
 * @method static Builder|ResearchProposal search(?string $keyword, array $columns = [], array $relations = [])
 * @method static Builder|ResearchProposal searchManual(?string $keyword)
 * @method static Builder|ResearchProposal whereApplicationStatus($value)
 * @method static Builder|ResearchProposal whereAuthorStatus($value)
 * @method static Builder|ResearchProposal whereContractPeriod($value)
 * @method static Builder|ResearchProposal whereCreatedAt($value)
 * @method static Builder|ResearchProposal whereFundingAmount($value)
 * @method static Builder|ResearchProposal whereGrantScheme($value)
 * @method static Builder|ResearchProposal whereId($value)
 * @method static Builder|ResearchProposal whereJournalAccreditationStatus($value)
 * @method static Builder|ResearchProposal whereJournalName($value)
 * @method static Builder|ResearchProposal whereJournalPdfFile($value)
 * @method static Builder|ResearchProposal whereJournalPublicationLink($value)
 * @method static Builder|ResearchProposal whereProposalFile($value)
 * @method static Builder|ResearchProposal whereProposalTitle($value)
 * @method static Builder|ResearchProposal wherePublicationDateYear($value)
 * @method static Builder|ResearchProposal wherePublicationTitle($value)
 * @method static Builder|ResearchProposal wherePublicationYear($value)
 * @method static Builder|ResearchProposal wherePublisher($value)
 * @method static Builder|ResearchProposal whereSdmId($value)
 * @method static Builder|ResearchProposal whereTargetOutcomes($value)
 * @method static Builder|ResearchProposal whereUpdatedAt($value)
 * @method static Builder|ResearchProposal whereVerification($value)
 * @method static Builder|ResearchProposal whereVolumeNumber($value)
 * @method static Builder|ResearchProposal workHours()
 * @mixin \Eloquent
 */
class ResearchProposal extends Model
{
    use HasFactory, UtilsFunction;

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

    public function letterNumber()
    {
        return $this->hasOne(LetterNumber::class);
    }
}
