<?php

namespace App\Models\Wr3;

use App\Models\HumanResource;
use App\Traits\Model\UtilsFunction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * App\Models\Wr3\OffCampusActivity
 *
 * @property int $id
 * @property int|null $sdm_id
 * @property string $title
 * @property string $location
 * @property string $performance_certificate
 * @property string $budget_source
 * @property string $execution_date
 * @property string $funding_amount
 * @property string $number_of_students
 * @property mixed $students
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read HumanResource|null $humanResource
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity export(?array $columns = null)
 * @method static \Database\Factories\Wr3\OffCampusActivityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity search(?string $keyword, array $columns = [], array $relations = [])
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity searchManual(?string $keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereBudgetSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereExecutionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereFundingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereNumberOfStudents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity wherePerformanceCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereStudents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OffCampusActivity workHours()
 * @mixin \Eloquent
 */
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
