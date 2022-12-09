<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public static $active_status_name = [
        [
            'text' => 'Aktif',
            'value' => 'Aktif'
        ],
        [
            'text' => 'Tidak Aktif',
            'value' => 'Tidak Aktif'
        ]
    ];
    public static $employee_status = [
        [
            'text' => 'PNS',
            'value' => 'PNS'
        ],
        [
            'text' => 'NON PNS',
            'value' => 'NON PNS'
        ]
    ];
    public static $sdm_type = [
        [
            'text' => 'Dosen',
            'value' => 'Dosen'
        ],
        [
            'text' => 'Dosen DT',
            'value' => 'Dosen DT'
        ],
        [
            'text' => 'Tenaga kependidikan',
            'value' => 'Tenaga kependidikan'
        ],
        [
            'text' => 'Security',
            'value' => 'Security'
        ],
        [
            'text' => 'Customer Service',
            'value' => 'Customer Service'
        ]
    ];

    public static $is_sister_exist = [
        [
            'text' => 'Terdaftar',
            'value' => 1
        ],
        [
            'text' => 'Tidak Terdaftar',
            'value' => 0
        ]
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

    public function user()
    {
        return $this->hasOne(User::class, 'nip', 'nip');
    }

    public function faculty()
    {
        return $this->hasOne(Faculty::class);
    }

    public function studyProgram()
    {
        return $this->hasOne(StudyProgram::class);
    }

    public function structure()
    {
        return $this->hasOne(Structure::class);
    }
}
