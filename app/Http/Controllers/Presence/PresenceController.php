<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\StorePresenceRequest;
use App\Http\Requests\Presence\UpdatePresenceRequest;
use App\Models\Presence;
use App\Models\HumanResource;
use App\Models\Subject;
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
            ->with('withDate', true)
            ->with('exportUrl', route('download.my-presence', request()->getQueryString()))
            ->with('presences', Presence::getPresences([Auth::id()]))
            ->with('hours', Presence::getPresenceHours(Auth::id()));
    }

    public function subPresenceByCivitas()
    {
        return view('presence.dashboard.structural')
            ->with('withDate', true)
            ->with('exportUrl', route('download.per-civitas', request()->getQueryString()))
            ->with('presences', Presence::subPresenceByCivitas());
    }

    public function subPresenceAll()
    {
        return view('presence.dashboard.index')
            ->with('withDate', true)
            ->with('exportUrl', route('download.civitas-all', request()->getQueryString()))
            ->with('presences', Presence::subPresenceAll());
    }

    public function subLecturer()
    {
        return view('presence.dashboard.lecturer')
            ->with('exportUrl', route('download.sub-lecturer', request()->getQueryString()))
            ->with('lecturers', Subject::subLecturer());
    }

    public function allLecturer()
    {
        return view('presence.dashboard.lecturer')
            ->with('exportUrl', route('download.all-lecturer', request()->getQueryString()))
            ->with('lecturers', Subject::allLecturer());
    }

    public function dsdmByCivitas()
    {
        return view('presence.dashboard.structural')
            ->with('exportUrl', route('download.dsdm-civitas', request()->getQueryString()))
            ->with('withDate', true)
            ->with('presences', Presence::dsdmByCivitas());
    }

    public function dsdmAllCivitas()
    {
        return view('presence.dashboard.index')
            ->with('withDate', true)
            ->with('exportUrl', route('download.dsdm-civitas-all', request()->getQueryString()))
            ->with('presences', Presence::dsdmAllCivitas());
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
            ->with('exportUrl', route('download.detail', ['sdm_id' => $sdm_id]))
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
