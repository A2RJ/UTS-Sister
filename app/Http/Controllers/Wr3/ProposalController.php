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
// use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Crypt;
use URL;

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

    public function show(ResearchProposal $proposal)
    {
        return view('wr3.proposal.detail')
            ->with('statuses', $this->statuses)
            ->with('author_statuses', $this->author_statuses)
            ->with('journal_accreditation_statuses', $this->journal_accreditation_statuses)
            ->with('proposal', $proposal);
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

    public function isDateString($string)
    {
        // Coba parse string sebagai timestamp
        $timestamp = strtotime($string);

        // Periksa apakah konversi berhasil dan apakah tanggalnya sama dengan string input
        return $timestamp !== false && date('Y-m-d', $timestamp) == $string;
    }

    public function generateLetter(ResearchProposal $proposal)
    {
        $kop = FileHelper::toBase64(public_path('kop-surat/pengabdian.png'));

        $activityStartDate = Carbon::parse($proposal->start);
        $activityEndDate = '';
        if ($this->isDateString($proposal->end)) {
            $activityEndDate = Carbon::parse($proposal->end)->addMonths(1);
        } else {
            $parts = explode(" ", $proposal->end);

            // Konversi bulan ke angka menggunakan switch
            $bulan_angka = 0;
            switch (strtolower($parts[1])) {
                case "januari":
                    $bulan_angka = 1;
                    break;
                case "februari":
                    $bulan_angka = 2;
                    break;
                case "maret":
                    $bulan_angka = 3;
                    break;
                case "april":
                    $bulan_angka = 4;
                    break;
                case "mei":
                    $bulan_angka = 5;
                    break;
                case "juni":
                    $bulan_angka = 6;
                    break;
                case "juli":
                    $bulan_angka = 7;
                    break;
                case "agustus":
                    $bulan_angka = 8;
                    break;
                case "september":
                    $bulan_angka = 9;
                    break;
                case "oktober":
                    $bulan_angka = 10;
                    break;
                case "november":
                    $bulan_angka = 11;
                    break;
                case "desember":
                    $bulan_angka = 12;
                    break;
            }

            // Format tanggal dalam format "YYYY-MM"
            $tanggal_format = $parts[2] . "-" . str_pad($bulan_angka, 2, "0", STR_PAD_LEFT);

            // Menampilkan hasil

            $activityEndDate = Carbon::parse($tanggal_format)->addMonths(1);
        }

        $startMonth = DateHelper::formatBulanTahunId($activityStartDate);
        $endMonth = DateHelper::formatBulanTahunId($activityEndDate);

        $detail = '';
        if ($activityStartDate->diffInMonths($activityEndDate) == 1) {
            $detail = "selama 1 bulan terhitung sejak $startMonth";
        } else {
            $detail = "selama " . $activityStartDate->diffInMonths($activityEndDate) . " bulan terhitung sejak $startMonth - $endMonth";
        }

        $url = env('APP_ENV') == 'production' ? 'https://kepegawaian.uts.ac.id' : 'http://127.0.0.1:8000';

        $values = [
            'token'        => "$url/v/rinov/$proposal->id",
            'number'       => $proposal->letterNumber->number,
            'month'        => DateHelper::bulanToRomawi($proposal->letterNumber->month),
            'year'         => $proposal->letterNumber->year,
            'title'        => $proposal->proposal_title,
            'participants' => json_decode($proposal->participants),
            'start'        => $startMonth,
            'end'          => $endMonth,
            'location'     => $proposal->location,
            'detail'       => $detail,
            'accepted_date' => DateHelper::formatTglId($proposal->letterNumber->accepted_date, false),
        ];
        return view('surat.surat-penelitian', compact('kop', 'values'));
        // $pdf = \PDF::loadView('surat/surat-penelitian', compact('kop', 'values'));
        // $pdf->setOption('enable-javascript', true);
        // $pdf->setOption('javascript-delay', 5000);
        // $pdf->setOption('enable-smart-shrinking', true);
        // $pdf->setOption('no-stop-slow-scripts', true);
        // return $pdf->stream(Auth::user()->sdm_name . '.pdf');
    }
}
