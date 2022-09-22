<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\VarDumper\VarDumper;

class SDM extends Model
{
    use HasFactory;

    public $table = "sdm";

    public static function searchSDM()
    {
        $sdm = SDM::query();
        $nama_sdm = request('nama');
        if ($nama_sdm) {
            return $sdm->where('nama_sdm', "LIKE", "%$nama_sdm%")->paginate();
        } else {
            return $sdm->paginate();
        }
    }
}
