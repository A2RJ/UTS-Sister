<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Faculty
 *
 * @property int $id
 * @property string $faculty
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereFaculty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereId($value)
 * @mixin \Eloquent
 */
class Faculty extends Model
{
    use HasFactory;

    public $fillable = ['faculty'];
    public $timestamps = false;
}
