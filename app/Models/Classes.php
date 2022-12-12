<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    public $table = "classes";

    protected $fillable = ["study_program_id", "class"];

    public $timestamps = false;

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }
    public static function selectOption()
    {
        return self::select('id as value', 'class as text')->get();
    }
}
