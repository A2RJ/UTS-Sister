<?php

namespace App\Models\Wr3;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffCampusActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'sdm_id',
        'title',
        'location',
        'performance_certificate',
        'budget_source',
        'funding_amount',
        'execution_date',
        'number_of_students',
        'students'
    ];

    public function humanResource()
    {
        return $this->belongsTo(HumanResource::class);
    }
}
