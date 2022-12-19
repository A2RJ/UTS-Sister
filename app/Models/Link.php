<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ["meeting_id", "link"];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }
}
