<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presence;

class DSDMController extends Controller
{
    public function index()
    {
        return view('presence.sub.index')
            ->with('withDate', true)
            ->with('exportUrl', route('download.dsdm-presence', request()->getQueryString()))
            ->with('presences', Presence::dsdmPresence())
            ->with('hours', Presence::totalPresenceHour(true));
    }
}
