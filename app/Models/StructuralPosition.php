<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
