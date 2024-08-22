<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bkd
 *
 * @property int $id
 * @property string $human_resource_id
 * @property string $period
 * @property string $status
 * @property string $jafung
 * @property string $ab
 * @property string $c
 * @property string $d
 * @property string $e
 * @property string $total
 * @property string $summary
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HumanResource|null $sdm
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereHumanResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereJafung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
