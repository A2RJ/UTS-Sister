<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramAPIController extends Controller
{
    public function index()
    {
        $study_program = StudyProgram::all();
        return response()->json([
            'data' => $study_program
        ], 200);
    }
}
