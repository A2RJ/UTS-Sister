<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Wr3\Dedication;
use App\Models\Wr3\LecturerDetail;
use App\Models\Wr3\ResearchProposal;
use App\Traits\Auth\User\RoleStructure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $sdm_id
 * @property string|null $sdm_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
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
 * @property-read LecturerDetail|null $detail
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read int|null $presence_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ResearchProposal> $researchProposal
 * @property-read int|null $research_proposal_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read int|null $structure_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmployeeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsSisterExist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMacAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNidn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProgramStudiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSdmName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSdmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSdmTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, RoleStructure;

    public $table = 'human_resources';
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function structure()
    {
        return $this->hasManyThrough(
            Structure::class,
            StructuralPosition::class,
            'sdm_id', // Foreign key on struktural table...
            'id', // Foreign key on structure table...
            'id', // Local key on users table...
            'structure_id' // Local key on struktural table...
        );
    }

    public function presence()
    {
        return $this->hasMany(Presence::class, 'sdm_id');
    }

    public static function subDivision()
    {
        return Structure::getSdmOneLevelUnder();
    }

    public static function prodi()
    {
        return collect(Structure::getOwnStructure())->filter(function ($item) {
            return $item['type'] === "prodi";
        });
    }

    public static function prodiList()
    {
        return collect(User::subDivision())->filter(function ($item) {
            return $item['type'] === "prodi";
        })->values();
    }

    public static function subHasRoleType($roleOrType, $field = 'type')
    {
        $sub = collect(User::subDivision())->filter(function ($sub) use ($roleOrType, $field) {
            return $sub[$field] === $roleOrType;
        });
        return $sub;
    }

    public static function subOtherRoleType($roleOrType, $field = 'type')
    {
        $sub = collect(User::subDivision())->filter(function ($sub) use ($roleOrType, $field) {
            return $sub[$field] !== $roleOrType;
        });
        return $sub;
    }

    public function detail()
    {
        return $this->hasOne(LecturerDetail::class, 'sdm_id');
    }

    public function researchProposal()
    {
        return $this->hasMany(ResearchProposal::class, 'sdm_id');
    }

    public function dedication()
    {
        return $this->hasMany(Dedication::class, 'sdm_id');
    }
}
