<?php

namespace App\Traits\Auth;

use App\Models\Structure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait Structures
{
    public static function checkRoleType($params, $roleOrType = 'role')
    {
        $roles = Auth::user()->structure;
        if (!$roles) return false;
        $hasRole = collect($roles)->filter(function ($roleItem) use ($params, $roleOrType) {
            return Str::lower($roleItem[$roleOrType]) === Str::lower($params);
        })->count();
        return $hasRole > 0 ? true : false;
    }

    public static function isMissingRole()
    {
        return Structure::getOwnStructure() ? false : true;
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

    public function isDSDM()
    {
        return $this->checkRoleType('639eb26622219DirektoratSumberDayaManusia', 'child_id');
    }

    public function isSecurity()
    {
        return $this->checkRoleType('security', 'type');
    }
}
