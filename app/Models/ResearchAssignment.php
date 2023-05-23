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
        'dateStart',
        'dateEnd',
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

    public function user()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }

    public function scopeSearch($query)
    {
        $search = request('search');
        return $query->where('role', 'like', "%$search%")
            ->orWhere('activity', 'like', "%$search%")
            ->orWhere('as', 'like', "%$search%")
            ->orWhere('theme', 'like', "%$search%")
            ->orWhere('dateStart', 'like', "%$search%")
            ->orWhere('dateEnd', 'like', "%$search%")
            ->orWhere('organizer', 'like', "%$search%")
            ->orWhere('location', 'like', "%$search%");
    }

    public function isDocumentNumberingFilled()
    {
        return $this->number &&
            $this->month &&
            $this->year;
    }
}
