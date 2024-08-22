<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ResearchAssignment
 *
 * @property-read \App\Models\HumanResource $user
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment search()
 * @property int $id
 * @property int|null $sdm_id
 * @property string $role
 * @property string $activity
 * @property string $as
 * @property string $theme
 * @property string $dateStart
 * @property string|null $dateEnd
 * @property string $organizer
 * @property string $location
 * @property array $table
 * @property int|null $number
 * @property string|null $month
 * @property int|null $year
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereOrganizer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereYear($value)
 * @mixin \Eloquent
 */
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
