<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bkd extends Model
{

	static $rules = [
		'human_resource_id' => 'required',
		'period' => 'required',
		'status' => 'required',
		'jafung' => 'required',
		'ab' => 'required|numeric',
		'c' => 'required|numeric',
		'd' => 'required|numeric',
		'e' => 'required|numeric',
		'total' => 'required|numeric',
		'summary' => 'required',
		'description' => 'nullable',
	];

	protected $perPage = 20;

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['human_resource_id', 'period', 'status', 'jafung', 'ab', 'c', 'd', 'e', 'total', 'summary', 'description'];

	public function sdm()
	{
		return $this->belongsTo(HumanResource::class, 'human_resource_id', 'id');
	}
}
