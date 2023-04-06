<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Auth\User\RoleStructure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

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
}
