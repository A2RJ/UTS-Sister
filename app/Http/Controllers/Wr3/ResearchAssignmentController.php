<?php

namespace App\Http\Controllers\Wr3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResearchAssignmentController extends Controller
{
    public function suratTugas()
    {
        return view('wr3.rinov.ajukan-surat-tugas');
    }
}
