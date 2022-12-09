<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    protected $fillable = ["faculty_id", "study_program"];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function class()
    {
        return $this->hasMany(Classes::class);
    }

    public function humanResource()
    {
        return $this->hasOne(HumanResource::class);
    }
}
