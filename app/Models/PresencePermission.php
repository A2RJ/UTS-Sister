<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresencePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'sdm_id',
        'check_in_time',
        'latitude_in',
        'longitude_in',
        'check_out_time',
        'latitude_out',
        'longitude_out'
    ];

    public function attachment()
    {
        return $this->hasOne(PresenceAttachment::class, 'presence_id');
    }
}
