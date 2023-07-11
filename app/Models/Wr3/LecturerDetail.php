<?php

namespace App\Models\Wr3;

use App\Models\Faculty;
use App\Models\HumanResource;
use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wr3\LecturerDetail
 *
 * @property int $id
 * @property int|null $sdm_id
 * @property int $faculty_id
 * @property int $study_program_id
 * @property string $expertise
 * @property string $theme
 * @property string $other_theme
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Wr3\LecturerDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereExpertise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereOtherTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereStudyProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereUpdatedAt($value)
 * @property-read Faculty $faculty
 * @property-read HumanResource|null $humanResource
 * @property-read StudyProgram $studyProgram
 * @mixin \Eloquent
 */
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
