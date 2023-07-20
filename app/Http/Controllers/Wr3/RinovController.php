<?php

namespace App\Http\Controllers\Wr3;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wr3\LecturerDetailRequest;
use App\Models\Faculty;
use App\Models\Wr3\LecturerDetail;
use App\Models\Wr3\ResearchProposal;
use Illuminate\Support\Facades\Auth;

class RinovController extends Controller
{ 

    public function dataDosen()
    {
        return view('wr3.profile-dosen')
        ->with('user', Auth::user())
            ->with('detail', LecturerDetail::whereSdmId(Auth::id())->first())
            ->with('faculties', Faculty::all())
            ->with('themes', [
                'Green economy',
                'Blue economy',
                'Social science',
                'Humaniora',
                'Engineering',
                'Lain-lain'
            ]);
    }

    public function postDataDosen(LecturerDetailRequest $request)
    {
        $validated = $request->validated();
        $validated['faculty_id'] = $validated['faculty'];
        $validated['study_program_id'] = $validated['study_program'];

        $request->user()->detail()->updateOrCreate(
            ['sdm_id' => Auth::id()],
            $validated
        );

        return back();
    }

    public function tambahProposal()
    {
    }

    public function destroyProposal(ResearchProposal $proposal)
    {
        if ($proposal->sdm_id != Auth::id()) return back()->with('fail', 'Unauthorized!');
        $proposal->delete();
        return back()->with('success', 'Data proposal berhasil didelete!');
    }

    public function kegiatanLuarKampus()
    {
        return view('wr3.off-campus-activity.aktivitas');
    } 
}
