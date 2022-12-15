<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumanResource extends Model
{
    use HasFactory;

    protected $fillable = [
        "sdm_id",
        "sdm_name",
        "email",
        "email_verified_at",
        "password",
        "remember_token",
        "nidn",
        "nip",
        "active_status_name",
        "employee_status",
        "sdm_type",
        "is_sister_exist"
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'text' => 'Rektor',
            'value' => 'Rektor'
        ],
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
        $sdm = HumanResource::query();
        $nama_sdm = request('nama');
        if ($nama_sdm) {
            return $sdm->where('sdm_name', "LIKE", "%$nama_sdm%")->paginate();
        } else {
            return $sdm->paginate();
        }
    }

    public static function selectOption()
    {
        return HumanResource::select('id as value', 'sdm_name as text')->where('sdm_type', 'Dosen')->get();
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'sdm_id', 'id');
    }

    public function presence()
    {
        return $this->hasMany(Presence::class, 'sdm_id', 'id');
    }

    public static function lecturerList()
    {
        return HumanResource::whereIn('id', User::getChildrenSdmId()->unique())->get();
    }
}
