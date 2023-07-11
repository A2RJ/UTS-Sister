<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Semester
 *
 * @property int $id
 * @property string $semester
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester query()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereSemester($value)
 * @mixin \Eloquent
 */
class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['semester'];

    public $timestamps = false;

    public static function selectOption()
    {
        return Semester::select('id as value', 'semester as text')->get();
    }
}
