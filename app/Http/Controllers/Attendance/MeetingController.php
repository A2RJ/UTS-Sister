<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\Subject;
use App\Http\Requests\Meeting\StoreMeetingRequest;
use App\Http\Requests\Meeting\UpdateMeetingRequest;

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
        $form = $request->safe()->only(["subject_id", "meeting_name", "datetime_local"]);
        $meeting->update($form);
        return redirect(route('meeting.index'))->with('message', 'Berhasil tambah jadwal perkuliahan');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect(route('meeting.index'))->with('message', 'Berhasil delete jadwal perkuliahan');
    }
}
