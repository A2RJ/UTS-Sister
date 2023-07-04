<?php

namespace App\Traits\Auth\User;

use App\Models\StructuralPosition;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait RoleStructure
{
    public static function checkRoleType($params, $column = 'role')
    {
        $roles = Auth::user()->structure;
        if (!$roles) return false;
        $hasRole = collect($roles)->filter(function ($roleItem) use ($params, $column) {
            return Str::lower($roleItem[$column]) === Str::lower($params);
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
        return $this->checkRoleType('dosen', 'type') || $this->checkRoleType('Dosen', 'type');
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

    public function rinov()
    {
        return $this->checkRoleType('Direktorat Riset & Inovasi', 'role');
        return StructuralPosition::where('id', 36)->exists();
    }

    public function pengabdian()
    {
        return $this->checkRoleType('Direktorat Pengabdian Kepada Masyarakat', 'role') ||
        $this->checkRoleType('Staf Direktorat Pengabdian Kepada Masyarakat', 'role');
    }
}
