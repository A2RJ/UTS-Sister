<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StructuralPosition
 *
 * @property int $id
 * @property int|null $sdm_id
 * @property int|null $structure_id
 * @property-read \App\Models\HumanResource|null $humanReource
 * @property-read \App\Models\Structure|null $structure
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition whereStructureId($value)
 * @mixin \Eloquent
 */
class StructuralPosition extends Model
{
    /**
     * Perhatikan bahwa updateOrCreate hanya dapat digunakan pada relasi "one-to-one" atau "one-to-many". 
     * Jika Anda memiliki relasi "many-to-many", Anda harus menggunakan method sync atau syncWithoutDetaching 
     * untuk membuat atau meng-update record pada tabel pivot.
     */
    use HasFactory;

    public $table = "structural_positions";

    public $fillable = ['sdm_id', 'structure_id'];

    public $timestamps = false;

    public function humanReource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class, 'structure_id');
    }
}
