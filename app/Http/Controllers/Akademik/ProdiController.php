<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        return view('academics.prodi.index')
            ->with('study_programs', User::prodiList());
    }
}
