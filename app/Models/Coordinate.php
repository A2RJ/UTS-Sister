<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Coordinate
 *
 * @property int $id
 * @property string $latitude
 * @property string $longitude
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Coordinate extends Model
{
    use HasFactory;

    public $table = 'coordinates';
}
