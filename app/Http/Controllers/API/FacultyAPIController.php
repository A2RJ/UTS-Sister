<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyAPIController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all();
        return response()->json([
            'data' => $faculties
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'faculty' => 'required'
        ]);

        $faculty = Faculty::create($request->only('faculty'));
        return response()->json([
            'data' => $faculty
        ], 200);
    }
}
