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

    public $table = "human_resources";

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

    public function profile()
    {
        return $this->hasOne(HumanResource::class, 'nip', 'nip');
    }

    public function structure()
    {
        return $this->hasOne(Structure::class, 'id', 'structure_id');
    }

    public function isRektor()
    {
        if (!Auth::user()->structure) return false;
        return Str::lower(Auth::user()->structure->role) === "rektor" ? true : false;
    }

    public function isAdmin()
    {
        if (!Auth::user()->structure) return false;
        return Str::lower(Auth::user()->structure->role) === "admin" ? true : false;
    }

    public function isLecturer()
    {
        return Str::lower(Auth::user()->sdm_type)  === "dosen" ? true : false;
    }

    public function isEduStaff()
    {
        return Str::lower(Auth::user()->sdm_type) === "tenaga kependidikan" ? true : false;
    }

    public function hasSub()
    {
        if (!Auth::user()->structure) return false;
        $result = Structure::childrens(Auth::user()->structure->child_id);
        return $result ? true : false;
    }

    public static function child_id()
    {
        return Auth::user()->structure ? Auth::user()->structure->child_id : 0;
    }
}
