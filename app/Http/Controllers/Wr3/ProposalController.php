<?php

namespace App\Http\Controllers\Wr3;

use App\Helpers\DateHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wr3\LetterNumeringRequest;
use App\Http\Requests\Wr3\ResearchProposalRequest;
use App\Http\Requests\Wr3\ResearchProposalUpdateRequest;
use App\Models\Wr3\ResearchProposal;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ProposalController extends Controller
{
    public  $statuses = ['Lolos pendanaan', 'Selesai penelitian'],
        $author_statuses = [1, 2, 3, 'correspondence author'],
        $journal_accreditation_statuses = ['International', 'Nationally accredited', 'Internal'];

    public function dosen()
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
            ->whereSdmId(Auth::id())
            ->paginate();

        return view('wr3.proposal.user')
            ->with('researches', $researches);
    }

    public function index()
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

        return view('wr3.proposal.index')
            ->with('researches', $researches)
            ->with('exportUrl', ''); // route('download.proposal', request()->getQueryString())
    }

    public function create()
    {
        return view('wr3.proposal.create')
            ->with('statuses', $this->statuses)
            ->with('author_statuses', $this->author_statuses)
            ->with('journal_accreditation_statuses', $this->journal_accreditation_statuses);
    }

    public function store(ResearchProposalRequest $request)
    {
        $validated = $request->validated();
        $validated['participants'] = json_encode($request->participants);
        $validated['proposal_file'] = FileHelper::upload($request, 'proposal_file', 'proposal_file');
        if ($request->hasFile('journal_pdf_file')) {
            $validated['journal_pdf_file'] = FileHelper::upload($request, 'journal_pdf_file', 'journal_pdf_file');
        }
        $research = Auth::user()->researchProposal()->create($validated);
        return redirect()->route('proposal.by-user')->with('message', 'Berhasil tambah proposal');
    }

    public function edit(ResearchProposal $proposal)
    {
        return view('wr3.proposal.edit')
            ->with('statuses', $this->statuses)
            ->with('author_statuses', $this->author_statuses)
            ->with('journal_accreditation_statuses', $this->journal_accreditation_statuses)
            ->with('proposal', $proposal);
    }

    public function update(ResearchProposalUpdateRequest $request, ResearchProposal $proposal)
    {
        if ($proposal->sdm_id == Auth::id()) {
            $validated = $request->validated();
            if ($request->hasFile('proposal_file')) {
                $validated['proposal_file'] = FileHelper::upload($request, 'proposal_file', 'proposal_file');
            }
            if ($request->hasFile('journal_pdf_file')) {
                $validated['journal_pdf_file'] = FileHelper::upload($request, 'journal_pdf_file', 'journal_pdf_file');
            }
            $proposal->update($validated);
            return redirect()->route('proposal.by-user')->with('message', 'Berhasil tambah proposal');
        }
        return back();
    }

    public function destroy(ResearchProposal $proposal)
    {
        if ($proposal->sdm_id == Auth::id()) {
            $proposal->delete();
            return back()->with('success', 'Berhasil dihapus');
        }
        return back()->with('failed', 'Anda tidak dapat menghapus data proposal');
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

    public function formNumbering(ResearchProposal $proposal)
    {
        return view('wr3.letter-number')
        ->with('route', route('proposal.letterNumbering', $proposal->id))
            ->with('letterNumber', $proposal->letterNumber);
    }

    public function letterNumbering(LetterNumeringRequest $request, ResearchProposal $proposal)
    {
        $proposal->letterNumber()->updateOrCreate(['proposal_id' => $proposal->id], $request->validated());
        return redirect()->route('proposal.index')->with('success', 'Berhasil set nomor surat');
    }

    public function generateLetter(ResearchProposal $proposal)
    {
        $kop = FileHelper::toBase64(public_path('kop-surat/pengabdian.png'));

        $activityStartDate = Carbon::parse($proposal->start);
        $activityEndDate = Carbon::parse($proposal->end)->addMonth(); // Tambahkan 1 bulan ke akhir tanggal

        $startMonth = DateHelper::formatBulanTahunId($activityStartDate);
        $endMonth = DateHelper::formatBulanTahunId($activityEndDate);

        $detail = '';
        if ($activityStartDate->diffInMonths($activityEndDate) == 1) {
            $detail = "selama 1 bulan terhitung sejak $startMonth";
        } else {
            $detail = "selama " . $activityStartDate->diffInMonths($activityEndDate) . " bulan terhitung sejak $startMonth - $endMonth";
        }

        $values = [
            'number'      => $proposal->letterNumber->number,
            'month'       => DateHelper::bulanToRomawi($proposal->letterNumber->month),
            'year'        => $proposal->letterNumber->year,
            'title'       => $proposal->proposal_title,
            'participants' => json_decode($proposal->participants),
            'start'       => $startMonth,
            'end'         => $endMonth,
            'location'    => $proposal->location,
            'detail'      => $detail,
            'updated_at'  => DateHelper::formatTglId($proposal->letterNumber->updated_at, false)
        ];

        $pdf = Pdf::loadView('surat/surat-penelitian', compact('kop', 'values'));
        return $pdf->download(Auth::user()->sdm_name . '.pdf');
    }

}
