<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meeting\EndMeeting;
use App\Http\Requests\Meeting\StartMeeting;
use App\Models\Meeting;

class MeetingAPIController extends Controller
{
    public function meeting($subject_id)
    {
        return response([
            'data' => Meeting::where('subject_id', $subject_id)->get()
        ]);
    }

    public function startMeeting(StartMeeting $request, $subject_id, $meeting_id)
    {
        $meeting = Meeting::where('id', $meeting_id)->where('subject_id', $subject_id)->first();
        $meeting->update([
            'meeting_start' => date('Y-m-d H:i:s'),
            'file' => Meeting::upload($request, "file", $request->user()->id)
        ]);
        return response([
            'data' => 'Meeting dimulai'
        ]);
    }

    // public function endMeeting(EndMeeting $request, $subject_id, $meeting_id)
    // {
    //     $meeting = Meeting::where('id', $meeting_id)->where('subject_id', $subject_id)->first();
    //     $meeting->update([
    //         'meeting_end' => date('Y-m-d H:i:s'),
    //         'file_end' => Meeting::upload($request, "file", $request->user()->id)
    //     ]);
    //     return response([
    //         'data' => 'Meeting selesai'
    //     ]);
    // }
}
