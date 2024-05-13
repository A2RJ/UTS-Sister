<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bkd
 *
 * @property $id
 * @property $nidn
 * @property $lecture_name
 * @property $study_program
 * @property $status
 * @property $jafung
 * @property $ab
 * @property $c
 * @property $d
 * @property $e
 * @property $total
 * @property $summary
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Bkd extends Model
{
    
    static $rules = [
		'nidn' => 'required',
		'lecture_name' => 'required',
		'study_program' => 'required',
		'status' => 'required',
		'jafung' => 'required',
		'ab' => 'required',
		'c' => 'required',
		'd' => 'required',
		'e' => 'required',
		'total' => 'required',
		'summary' => 'required',
		'description' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nidn','lecture_name','study_program','status','jafung','ab','c','d','e','total','summary','description'];



}
