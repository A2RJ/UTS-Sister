<?php

namespace App\Models\Wr3;

use App\Models\HumanResource;
use App\Traits\Model\UtilsFunction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OffCampusActivity extends Model
{
    use HasFactory, UtilsFunction;

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

    public function humanResource(): BelongsTo
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }
}
