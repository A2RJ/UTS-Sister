<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ["faculty"];

    public function studyProgram()
    {
        return $this->hasMany(StudyProgram::class);
    }

    public function humanResource()
    {
        return $this->hasOne(HumanResource::class);
    }
}
