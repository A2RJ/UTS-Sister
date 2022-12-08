<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HumanResource extends Model
{
    use HasFactory;

    protected $fillable = [
        "sdm_id",
        "sdm_name",
        "nidn",
        "nip",
        "active_status_name",
        "employee_status",
        "sdm_type",
        "is_sister_exist",
        "faculty_id",
        "study_program_id",
        "structure_id",
    ];

    public function getRouteKeyName()
    {
        return 'sdm_id';
    }

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
