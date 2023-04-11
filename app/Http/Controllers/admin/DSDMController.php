<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use Illuminate\Http\Request;

class DSDMController extends Controller
{
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

    public function sdmPerUnit()
    {
        return view('presence.sub.index')
            ->with('withDate', true)
            ->with('exportUrl', route('download.dsdm-civitas-all', request()->getQueryString()))
            ->with('units', Presence::sdmPerUnit());
    }

    public function sdmPerUnitByStructure($structureId)
    {
        return view('presence.sub.index')
            ->with('withDate', true)
            ->with('exportUrl', route('download.dsdm-civitas-all', request()->getQueryString()))
            ->with('presences', Presence::sdmPerUnitByStructure($structureId))
            ->with('hours', Presence::totalHoursByStructure($structureId));
    }
}
