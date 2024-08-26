<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Participant
 *
 * @property int $id
 * @property int|null $human_resource_id
 * @property int|null $research_proposal_id
 * @property string $role
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereHumanResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereResearchProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUpdatedAt($value)
 * @property int|null $dedication_id
 * @property-read \App\Models\HumanResource|null $humanResource
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereDedicationId($value)
 * @mixin \Eloquent
 */
class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'human_resource_id',
        'role',
        'attachment'
    ];



    public function humanResource(): BelongsTo
    {
        return $this->belongsTo(HumanResource::class);
    }
}
