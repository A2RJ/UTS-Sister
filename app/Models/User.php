<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public $table = 'human_resources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public static function checkRoleType($params, $roleOrType = 'role')
    {
        $roles = Auth::user()->structure;
        if (!$roles) return false;
        $hasRole = collect($roles)->filter(function ($roleItem) use ($params, $roleOrType) {
            return Str::lower($roleItem[$roleOrType]) === Str::lower($params);
        })->count();
        return $hasRole > 0 ? true : false;
    }

    public function isRektor()
    {
        return $this->checkRoleType('rektor');
    }

    public function isAdmin()
    {
        return $this->checkRoleType('admin');
    }

    public function isLecturer()
    {
        return $this->checkRoleType('dosen', 'type');
    }

    public function isFaculty()
    {
        return $this->checkRoleType('fakultas', 'type');
    }

    public function isStudyProgram()
    {
        return $this->checkRoleType('prodi', 'type');
    }

    public function isStructural()
    {
        return $this->checkRoleType('struktural', 'type');
    }

    public function isDirAkademik()
    {
        return $this->checkRoleType('639eb2d054fd7DirektoratAkademik', 'child_id');
    }

    public static function prodi()
    {
        return collect(Auth::user()->structure)->filter(function ($item) {
            return $item['type'] === "prodi";
        });
    }

    public static function prodiList()
    {
        return collect(User::hasSub())->filter(function ($item) {
            return $item['type'] === "prodi";
        })->values();
    }

    public static function isMissingRole()
    {
        return collect(Auth::user()->structure)->count() === 0 ? true : false;
    }

    public static function hasSub()
    {
        $roles = Auth::user()->structure;
        if (!$roles || !count($roles) > 0) return [];
        $result = collect([]);
        collect($roles)->map(function ($structure) use ($result) {
            $child = collect(Structure::childrens($structure->child_id))->unique();
            $child->map(function ($item) use ($result) {
                $result->push($item);
            });
        });
        return $result;
    }

    public static function getChildrenSdmId()
    {
        $sdmId = collect(StructuralPosition::whereIn('structure_id', self::hasSub()->pluck('id'))->get());
        if ($sdmId->count() === 0) return [];
        return $sdmId->pluck('sdm_id');
    }

    public static function subHasRoleType($roleOrType, $field = 'type')
    {
        $sub = collect(self::hasSub())->filter(function ($sub) use ($roleOrType, $field) {
            return $sub[$field] === $roleOrType;
        });
        return $sub;
    }

    public static function subOtherRoleType($roleOrType, $field = 'type')
    {
        $sub = collect(self::hasSub())->filter(function ($sub) use ($roleOrType, $field) {
            return $sub[$field] !== $roleOrType;
        });
        return $sub;
    }
}
