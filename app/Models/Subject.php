<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ["subject", "sks", "number_of_meetings", "study_program_id", "sdm_id"];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
