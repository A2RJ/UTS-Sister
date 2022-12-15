<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'sks', 'number_of_meetings', 'class_id', 'sdm_id'];

    public $timestamps = false;

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function human_resource()
    {
        return $this->hasOne(HumanResource::class, 'id', 'sdm_id');
    }

    public static function selectOption()
    {
        return self::select('id as value', 'subject as text')->get();
    }

    public static function lecturer()
    {
        $roles = User::hasSub();
        if ($roles && count($roles) === 0) return false;
        $data = Structure::join('structural_positions', 'structures.id', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', 'human_resources.id')
            ->select('structures.id', 'structures.role', 'structures.type', 'human_resources.sdm_name')
            ->where('structures.type', 'dosen')
            ->whereIn('structures.id', collect($roles)->pluck('id')->toArray())
            ->paginate();
        return $data;
    }
}
