<?php

namespace App\Http\Controllers\Wr3;

use App\Http\Controllers\Controller;
use App\Models\Wr3\OffCampusActivity;
use App\Models\Wr3\ResearchProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RinovController extends Controller
{
    public function researchProposal()
    {
        return view('wr3.rinov.proposal')
            ->with('researches', ResearchProposal::paginate());
    }

    public function offCampusActivity()
    {
        return view('wr3.rinov.off-campus-activity')
            ->with('offCampusActivities', OffCampusActivity::paginate());;
    }

    public function dataDosen()
    {
        return view('wr3.dosen');
    }

    public function proposal()
    {
        return view('wr3.proposal');
    }

    public function kegiatanLuarKampus()
    {
        return view('wr3.aktivitas');
    }
}
