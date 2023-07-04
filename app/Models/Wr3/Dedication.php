<?php

namespace App\Models\Wr3;

use App\Models\HumanResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
