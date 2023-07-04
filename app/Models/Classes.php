<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classes
 *
 * @property int $id
 * @property int|null $structure_id
 * @property string $class
 * @property-read \App\Models\Structure|null $structure
 * @method static \Illuminate\Database\Eloquent\Builder|Classes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereStructureId($value)
 * @mixin \Eloquent
 */
class Classes extends Model
{
    use HasFactory;

    public $table = "classes";

    protected $fillable = ["structure_id", "class"];

    public $timestamps = false;

    public static function selectOption()
    {
        return Classes::select('id as value', 'class as text')->get();
    }

    public static function prodiSelectOption($id)
    {
        return Classes::where('structure_id', $id)->select('id as value', 'class as text')->get();
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class, 'structure_id', 'id');
    }
}
