<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectAPIController extends Controller
{
    public function bySdm(Request $request)
    {
        return response()->json([
            'data' => Subject::bySdmIdAPI([$request->user()->id])
        ]);
    }

    public function today(Request $request)
    {
        return response()->json([
            'data' => Subject::today([$request->user()->id])
        ]);
    }

    public function show(Request $request, $subject_id)
    {
        return response([
            'data' => Subject::show($request->user()->id, $subject_id)
        ]);
    }
}
