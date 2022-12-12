<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ["faculty", 'sdm_id'];

    public $timestamps = false;

    public function studyProgram()
    {
        return $this->hasMany(StudyProgram::class);
    }

    public function humanResource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id', 'id');
    }

    public static function search()
    {
        $query = self::query();
        $faculty = request('faculty');
        if ($faculty) {
            return $query->where('faculty', "LIKE", "%$faculty%")->paginate();
        } else {
            return $query->paginate();
        }
    }

    public static function selectOption()
    {
        return self::select("id as value", "faculty as text")->get();
    }
}
