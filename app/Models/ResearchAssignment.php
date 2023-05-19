<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sdm_id',
        'role',
        'activity',
        'as',
        'theme',
        'date',
        'organizer',
        'location',
        'table',
        'number',
        'month',
        'year',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'table' => 'json',
        'status' => 'boolean',
    ];

    public function sdm()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }
}
