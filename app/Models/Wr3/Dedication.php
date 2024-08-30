<?php

namespace App\Models\Wr3;

use App\Models\HumanResource;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wr3\Dedication
 *
 * @property int $id
 * @property int $sdm_id
 * @property string $role
 * @property string $as
 * @property string $theme
 * @property string $title
 * @property string $funding_source
 * @property string $funding_amount
 * @property string $proposal_file
 * @property string $start_date
 * @property string $end_date
 * @property string $location
 * @property mixed $participants
 * @property string $target_activity_outputs
 * @property string $public_media_publications
 * @property string $scientific_publications
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read HumanResource $humanResource
 * @property-read \App\Models\Wr3\LetterNumber|null $letterNumber
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereActivitySchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereFundingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereFundingSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereProposalFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication wherePublicMediaPublications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereScientificPublications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereTargetActivityOutputs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereUpdatedAt($value)
 * @property string $report_file
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereReportFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereStartDate($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Participant> $participant
 * @property-read int|null $participant_count
 * @mixin \Eloquent
 */
class Dedication extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'as',
        'theme',
        'sdm_id',
        'title',
        'funding_source',
        'funding_amount',
        'proposal_file',
        'report_file',
        'start_date',
        'end_date',
        'location',
        'participants',
        'target_activity_outputs',
        'public_media_publications',
        'scientific_publications',
    ];

    public function humanResource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }

    public function letterNumber()
    {
        return $this->hasOne(LetterNumber::class);
    }

    public function participant()
    {
        return $this->hasMany(Participant::class);
    }
}
