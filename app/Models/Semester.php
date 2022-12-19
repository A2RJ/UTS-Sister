<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
