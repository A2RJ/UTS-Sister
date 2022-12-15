<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\HumanResource;
use App\Models\Structure;
use App\Models\Subject;
use App\Models\User;
use App\Traits\Utils\CustomPaginate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresenceController extends Controller
{
    use CustomPaginate;

    public function index()
    {
        return view('presence.index');
    }

    public function myPresence()
    {
        return view('presence.dashboard.index')
            ->with('presences', Presence::myPresence());
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Presence $presence)
    {
        //
    }

    public function detail($sdm_id)
    {
        return view('presence.dashboard.detail')
            ->with('sdm', HumanResource::where('id', $sdm_id)->first())
            ->with('structural', Presence::detail($sdm_id));
    }

    public function edit(Presence $presence)
    {
        //
    }


    public function update(Request $request, Presence $presence)
    {
        //
    }

    public function destroy(Presence $presence)
    {
        //
    }

    public function lecturer()
    {
        return view('presence.dashboard.lecturer')
            ->with('lecturers', Subject::lecturer());
    }

    public function structural()
    {
        return view('presence.dashboard.structural')
            ->with('structural', Presence::structural());
    }
}
