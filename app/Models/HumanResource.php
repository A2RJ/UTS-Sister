<?php

namespace App\Models;

use App\Traits\Model\UtilsFunction;
use App\Traits\Utils\File\Exel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\HumanResource
 *
 * @property int $id
 * @property string|null $sdm_id
 * @property string|null $sdm_name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $nidn
 * @property string|null $nip
 * @property string|null $active_status_name
 * @property string|null $employee_status
 * @property string|null $sdm_type
 * @property int|null $is_sister_exist
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int|null $program_studi_id
 * @property int|null $sdm_type_id
 * @property string|null $mac_address
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read int|null $presence_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read int|null $structure_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource export(?array $columns = null)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource search(?string $keyword, array $columns = [], array $relations = [])
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource searchManual(?string $keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereActiveStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereEmployeeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereIsSisterExist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereMacAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereNidn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereProgramStudiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereSdmName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereSdmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereSdmTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource workHours()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @mixin \Eloquent
 */
class HumanResource extends Model
{
    use HasFactory, Exel, UtilsFunction;

    protected $fillable = [
        'sdm_id',
        'sdm_name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'nidn',
        'nip',
        'active_status_name',
        'employee_status',
        'sdm_type',
        'program_studi_id',
        'is_sister_exist'
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
        $search = request('search');
        $sdm = HumanResource::query();
        if ($search) $sdm->where('sdm_name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('nidn', 'LIKE', "%$search%");
        return $sdm->paginate()
            ->appends(request()->except('page'));
    }

    public static function selectOption()
    {
        return HumanResource::select('id as value', 'sdm_name as text')->where('sdm_type', 'Dosen')->get();
    }

    public static function selectAllOption()
    {
        return HumanResource::select('id as value', 'sdm_name as text')->get();
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'sdm_id', 'id');
    }

    public function presence()
    {
        return $this->hasMany(Presence::class, 'sdm_id', 'id');
    }

    public function structure()
    {
        return $this->hasManyThrough(
            Structure::class,
            StructuralPosition::class,
            'sdm_id', // Foreign key on struktural table...
            'id', // Foreign key on structure table...
            'id', // Local key on sdm table...
            'structure_id' // Local key on struktural table...
        );
    }

    public function roles()
    {
        $structure = $this->structure;

        if (!$structure) {
            return '';
        }
        return $structure
            ->pluck('role')
            ->reject(function ($role) {
                return $role === 'admin';
            })
            ->implode(', <br>');
    }

    public static function lecturerList()
    {
        $sdmIds = Structure::getSdmIdOneLevelUnder();
        return HumanResource::whereIn('id', $sdmIds)->get();
    }
}
