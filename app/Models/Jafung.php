<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Jafung
 *
 * @property $id
 * @property $human_resource_id
 * @property $jafung
 * @property $sk_number
 * @property $start_from
 * @property $attachment
 * @property $created_at
 * @property $updated_at
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\Models\HumanResource|null $sdm
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereHumanResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereJafung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereSkNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereStartFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Jafung extends Model
{

  static $rules = [
    'jafung' => 'required',
    'sk_number' => 'required',
    'start_from' => 'required',
    'attachment' => 'required|file|mimes:pdf,doc,docx|max:10480',
  ];

  static $updateRules = [
    'jafung' => 'required',
    'sk_number' => 'required',
    'start_from' => 'required',
    'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:10480',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['human_resource_id', 'jafung', 'sk_number', 'start_from', 'attachment'];

  public function sdm()
  {
    return $this->belongsTo(HumanResource::class, 'human_resource_id');
  }
}
