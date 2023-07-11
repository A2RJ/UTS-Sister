<?php

namespace App\Models\Wr3;

use App\Models\HumanResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wr3\Dedication
 *
 * @property int $id
 * @property int $sdm_id
 * @property string $title
 * @property string $funding_source
 * @property string $funding_amount
 * @property string $proposal_file
 * @property string $activity_schedule
 * @property string $location
 * @property string $participants
 * @property string $target_activity_outputs
 * @property string $public_media_publications
 * @property string $scientific_publications
 * @property string $members
 * @property string $assignment_letter_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read HumanResource $humanResource
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication users()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereActivitySchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereAssignmentLetterLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereFundingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereFundingSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereMembers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereProposalFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication wherePublicMediaPublications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereScientificPublications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereTargetActivityOutputs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dedication extends Model
{
    use HasFactory;

    protected $fillable = [
        'sdm_id',
        'title',
        'funding_source',
        'funding_amount',
        'proposal_file',
        'activity_schedule',
        'location',
        'participants',
        'target_activity_outputs',
        'public_media_publications',
        'scientific_publications',
        'members',
        'assignment_letter_link',
    ];

    public function humanResource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }
}
