<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    use HasFactory;

    protected $fillable = ["class_id", "subject_id"];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
