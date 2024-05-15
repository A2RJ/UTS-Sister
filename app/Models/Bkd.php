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
		'nidn' => 'required|numeric',
		'period' => 'required',
		'lecture_name' => 'required|numeric',
		'status' => 'required',
		'jafung' => 'required',
		'ab' => 'required|numeric',
		'c' => 'required|numeric',
		'd' => 'required|numeric',
		'e' => 'required|numeric',
		'total' => 'required|numeric',
		'summary' => 'required',
		'description' => 'required',
	];

	protected $perPage = 20;

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nidn', 'period', 'lecture_name', 'status', 'jafung', 'ab', 'c', 'd', 'e', 'total', 'summary', 'description'];

	public function sdm()
	{
		return $this->belongsTo(HumanResource::class, 'lecture_name', 'id');
	}
}
