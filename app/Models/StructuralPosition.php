<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructuralPosition extends Model
{
    use HasFactory;

    public $table = "structural_positions";

    public $fillable = ['sdm_id', 'structure_id'];

    public $timestamps = false;
}
