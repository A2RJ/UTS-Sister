<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StudyProgram
 *
 * @property int $id
 * @property int|null $faculty_id
 * @property string $study_program
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereStudyProgram($value)
 * @mixin \Eloquent
 */
class StudyProgram extends Model
{
    use HasFactory;

    public $timestamps = false;
}
