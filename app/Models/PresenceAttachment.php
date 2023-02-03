<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceAttachment extends Model
{
    use HasFactory;

    public $table = "presence_attachment";
    public $timestamps = false;
    protected $fillable = ['presence_id', 'detail', 'attachment'];
}
