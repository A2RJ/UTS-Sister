<?php

namespace App\Traits\Subject;

use App\Models\Subject;
use Illuminate\Http\Request;

trait SubjectTrait
{
    public function byLecturerApi(Request $request)
    {
        return response([
            'data' => Subject::byLecturerApi($request->user()->id)
        ]);
    }

    public function subjectAggregateId(Request $request, $subject_id)
    {
        return response([
            'data' => Subject::subjectAggregateId($request->user()->id, $subject_id)
        ]);
    }

    public function today(Request $request)
    {
        return response([
            'data' => Subject::today($request->user()->id)
        ]);
    }
}
