<?php

namespace App\Models\Wr3;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sdm_id',
        'faculty_id',
        'study_program_id',
        'expertise',
        'theme',
        'other_theme'
    ];

    public function humanResource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
