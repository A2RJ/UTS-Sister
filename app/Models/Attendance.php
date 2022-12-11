<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['sdm_id', 'check_in_time', 'check_out_time'];

    public function human_resource()
    {
        return $this->belongsTo(HumanResource::class);
    }
}
