<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    public $table = "classes";

    protected $fillable = ["structure_id", "class"];

    public $timestamps = false;

    public static function selectOption()
    {
        return self::select('id as value', 'class as text')->get();
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class, 'structure_id', 'id');
    }
}
