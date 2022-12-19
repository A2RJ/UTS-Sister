<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\StorePresenceRequest;
use App\Http\Requests\Presence\UpdatePresenceRequest;
use App\Models\Presence;
use App\Models\HumanResource;
use App\Models\Subject;
use App\Models\User;
use App\Traits\Utils\CustomPaginate;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    use CustomPaginate;

    public function index()
    {
        return view('home');
    }

    public function myPresence()
    {
        return view('presence.dashboard.index')
            ->with('presences', Presence::getPresences([Auth::id()]));
    }

    public function structural()
    {
        return view('presence.dashboard.structural')
            ->with('presences', Presence::presences());
    }

    public function structuralAll()
    {
        return view('presence.dashboard.index')
            ->with('presences', Presence::getPresences(User::getChildrenSdmId()));
    }

    public function subLecturer()
    {
        return view('presence.dashboard.lecturer')
            ->with('lecturers', Subject::subLecturer());
    }

    public function lecturer()
    {
        return view('presence.dashboard.lecturer')
            ->with('lecturers', Subject::lecturer());
    }

    public function create()
    {
        return view('presence.dashboard.create')
            ->with('human_resources', HumanResource::selectAllOption());
    }

    public function store(StorePresenceRequest $request)
    {
        $form = $request->safe()->only(['sdm_id', 'check_in_time', 'latitude_in', 'longitude_in']);
        Presence::create($form);
        return redirect()->route('presence.index')->with('message', "Berhasil menambah presensi kehadiran");
    }

    public function detail($sdm_id)
    {
        return view('presence.dashboard.index')
            ->with('sdm', HumanResource::where('id', $sdm_id)->first())
            ->with('presences', Presence::getPresences([$sdm_id]));
    }

    public function edit(Presence $presence)
    {
        return view('presence.dashboard.edit')
            ->with('presence', $presence)
            ->with('human_resources', HumanResource::selectAllOption());
    }

    public function update(UpdatePresenceRequest $request, Presence $presence)
    {
        $form = $request->safe()->only(['check_out_time', 'latitude_out', 'longitude_out']);
        $presence->update($form);
        return redirect()->route('presence.index')->with('message', "Berhasil edit presensi kehadiran");
    }

    public function destroy(Presence $presence)
    {
        $presence->delete();
        return redirect()->route('presence.index')->with('message', "Berhasil hapus presensi kehadiran");
    }
}
