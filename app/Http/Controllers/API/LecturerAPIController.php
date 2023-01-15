<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HumanResource;
use Illuminate\Http\Request;

class LecturerAPIController extends Controller
{
    public function index()
    {
        $lecturer = HumanResource::where('sdm_type', 'LIKE', "%dosen%")
            ->leftJoin('study_programs', 'human_resources.program_studi_id', 'study_programs.id')
            ->leftJoin('faculties', 'study_programs.faculty_id', 'faculties.id')
            ->get();

        return response()->json([
            'data' => $lecturer
        ], 200);
    }

    public function setStudyProgram()
    {
        $lecturer = HumanResource::where('sdm_type', 'LIKE', "%dosen%")
            ->get();
        foreach ($lecturer as $row) {
            $row->program_studi_id = rand(1, 27);
            $row->save();
        }

        return response()->json([
            'data' => $lecturer
        ], 200);
    }
}
