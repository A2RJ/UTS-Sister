<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ["subject_id", "subject_class_id", "start", "end", "file_start", "file_end"];

    public $timestamps = false;

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function subjectClass()
    {
        return $this->belongsTo(SubjectClass::class);
    }
}
