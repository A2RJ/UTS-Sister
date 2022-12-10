<?php

namespace App\Http\Controllers\Attendance;

use App\Models\Meeting;
use App\Models\Subject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Meeting\EndMeeting;
use App\Http\Requests\Meeting\StartMeeting;
use App\Http\Requests\Meeting\StoreMeetingRequest;
use App\Http\Requests\Meeting\UpdateMeetingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    public function index()
    {
        return view('attendance.meeting.index')
            ->with('meetings', Meeting::paginate());
    }

    public function create()
    {
        return view('attendance.meeting.create')
            ->with('subjects', Subject::selectOption());
    }

    public function store(StoreMeetingRequest $request)
    {
        $form = $request->safe()->only(["subject_id", "meeting_name", "datetime_local"]);
        Meeting::create($form);
        return redirect(route('meeting.index'))->with('message', 'Berhasil tambah jadwal perkuliahan');
    }

    public function show(Meeting $meeting)
    {
        //
    }

    public function edit(Meeting $meeting)
    {
        return view('attendance.meeting.edit')
            ->with('meeting', $meeting)
            ->with('subjects', Subject::selectOption());
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        $form = $request->safe()->only(["subject_id", "meeting_name", "datetime_local", "meeting_start", "meeting_end", "file_start", "file_end"]);
        $file_start = Meeting::upload($request, "file_start", auth()->user()->id);
        $form['file_start'] = $file_start ? $file_start : $meeting->file_start;
        $file_end = Meeting::upload($request, "file_end", auth()->user()->id);
        $form['file_end'] = $file_end ? $file_end : $meeting->file_end;
        $meeting->update($form);
        return redirect(route('meeting.index'))->with('message', 'Berhasil edit jadwal perkuliahan');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect(route('meeting.index'))->with('message', 'Berhasil delete jadwal perkuliahan');
    }

    public function meeting($subject_id)
    {
        return response(Meeting::where('subject_id', $subject_id)->get());
    }

    public function startMeeting(StartMeeting $request, $subject_id, $meeting_id)
    {
        $meeting = Meeting::where('id', $meeting_id)->where('subject_id', $subject_id)->first();
        $meeting->update([
            'meeting_start' => date('Y-m-d H:i:s'),
            'file_start' => Meeting::upload($request, "file_start", $request->user()->id)
        ]);
        return response($meeting);
    }

    public function endMeeting(EndMeeting $request, $subject_id, $meeting_id)
    {
        $meeting = Meeting::where('id', $meeting_id)->where('subject_id', $subject_id)->first();
        $meeting->update([
            'meeting_end' => date('Y-m-d H:i:s'),
            'file_end' => Meeting::upload($request, "file_end", $request->user()->id)
        ]);
        return $meeting;
    }

    public function listMeeting(Request $request)
    {
        $results = Subject::join('meetings', 'meetings.subject_id', 'subjects.id')
            ->select(
                'subjects.*',
                DB::raw('SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) AS number_of_taken'),
                DB::raw('SUM(CASE WHEN meetings.file_start IS NULL OR meetings.file_end IS NULL THEN 1 ELSE 0 END) AS number_of_not_taken'),
                DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks')
            )
            ->where('subjects.sdm_id', $request->user()->id)
            ->with('study_program')
            ->groupBy('subjects.id')
            ->paginate();
        return response($results);
    }
}
