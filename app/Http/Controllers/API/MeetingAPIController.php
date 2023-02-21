<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meeting\EndMeeting;
use App\Http\Requests\Meeting\StartMeeting;
use App\Models\Link;
use App\Models\Meeting;

class MeetingAPIController extends Controller
{
    public function meeting($subject_id)
    {
        return response([
            'data' => Meeting::with('url:id,meeting_id,link')
                ->where('subject_id', $subject_id)
                ->select(
                    'meetings.id',
                    'meeting_name',
                    'date',
                    'meeting_start',
                    'file'
                )
                ->get()
        ]);
    }

    public function startMeeting(StartMeeting $request, $subject_id, $meeting_id)
    {
        $meeting = Meeting::where('id', $meeting_id)->where('subject_id', $subject_id)->first();
        if ($meeting->meeting_start) {
            return response([
                'data' => 'Meeting sudah dimulai ' . $meeting->meeting_start
            ]);
        }
        $meeting->update([
            'meeting_start' => date('Y-m-d\TH:i', strtotime($request->meeting_start)),
            'file' => Meeting::upload($request, "file", $request->user()->id)
        ]);
        $link = env('APP_REDIRECT') . "/verify?sharer=$meeting_id&is=" . uniqid();
        Link::create([
            'meeting_id' => $meeting_id,
            'link' => $link
        ]);
        return response([
            'data' => $link
        ]);
    }
}
