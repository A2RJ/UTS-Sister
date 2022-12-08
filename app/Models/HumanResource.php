<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HumanResource extends Model
{
    use HasFactory;

    public static function searchSDM()
    {
        $sdm = self::query();
        $nama_sdm = request('nama');
        if ($nama_sdm) {
            return $sdm->where('sdm_name', "LIKE", "%$nama_sdm%")->paginate();
        } else {
            return $sdm->paginate();
        }
    }
}
