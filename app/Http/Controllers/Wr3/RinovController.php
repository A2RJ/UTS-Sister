<?php

namespace App\Http\Controllers\Wr3;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wr3\LecturerDetailRequest;
use App\Models\Faculty;
use App\Models\Wr3\LecturerDetail;
use App\Models\Wr3\OffCampusActivity;
use App\Models\Wr3\ResearchProposal;
use Illuminate\Support\Facades\Auth;

class RinovController extends Controller
{
    public function researchProposal()
    {
        $keyword = request('keyword');
        $researches = ResearchProposal::search(
            $keyword,
            ['proposal_title', 'grant_scheme', 'target_outcomes', 'application_status', 'publication_title', 'author_status', 'journal_name'],
            [
                'humanResource' => function ($query) use ($keyword) {
                    $query->where('sdm_name', 'LIKE', '%' . $keyword . '%');
                }
            ]
        )
            ->paginate();

        return view('wr3.rinov.proposal')
            ->with('researches', $researches)
            ->with('exportUrl', route('download.proposal', request()->getQueryString()));
    }

    public function offCampusActivity()
    {
        $keyword = request('keyword');
        $offCampusActivities = OffCampusActivity::join('human_resources', 'off_campus_activities.sdm_id', 'human_resources.id')
            ->search(
                $keyword,
                ['title', 'location', 'performance_certificate', 'budget_source', 'funding_amount', 'execution_date', 'sdm_name'],
            )
            ->paginate();

        return view('wr3.rinov.off-campus-activity')
            ->with('offCampusActivities', $offCampusActivities)
            ->with('exportUrl', route('download.kegiatan-luar-kampus', request()->getQueryString()));
    }

    public function dataDosen()
    {
        return view('wr3.dosen')
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

        // if ($validated['theme'] == 'Lain-lain') {
        //     unset($validated['theme']);
        // } 

        $request->user()->detail()->updateOrCreate(
            ['sdm_id' => Auth::id()],
            $validated
        );

        return back();
    }

    public function proposal()
    {
        return view('wr3.proposal');
    }

    public function destroyProposal(ResearchProposal $proposal)
    {
        if ($proposal->sdm_id != Auth::id()) return back()->with('fail', 'Unauthorized!');
        $proposal->delete();
        return back()->with('success', 'Data proposal berhasil didelete!');
    }

    public function kegiatanLuarKampus()
    {
        return view('wr3.aktivitas');
    }

    public function destroyActivity(OffCampusActivity $activity)
    {
        if ($activity->sdm_id != Auth::id()) return back()->with('fail', 'Unauthorized!');
        $activity->delete();
        return back()->with('success', 'Data aktivitas di luar kampus berhasil didelete!');
    }

    public function downloadProposal()
    {
        $keyword = request('keyword');
        return ResearchProposal::search(
            $keyword,
            ['proposal_title', 'grant_scheme', 'target_outcomes', 'application_status', 'publication_title', 'author_status', 'journal_name'],
            [
                'humanResource' => function ($query) use ($keyword) {
                    $query->where('sdm_name', 'LIKE', '%' . $keyword . '%');
                }
            ]
        )->export();
    }

    public function downloadKegiatanLuarKampus()
    {
        $keyword = request('keyword');
        return OffCampusActivity::join('human_resources', 'off_campus_activities.sdm_id', 'human_resources.id')
            ->search(
                $keyword,
                ['title', 'location', 'performance_certificate', 'budget_source', 'funding_amount', 'execution_date', 'sdm_name'],
            )
            ->export();
    }
}
