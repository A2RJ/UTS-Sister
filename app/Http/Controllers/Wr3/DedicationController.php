<?php

namespace App\Http\Controllers\Wr3;

use App\Helpers\DateHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wr3\DedicationsRequest;
use App\Http\Requests\Wr3\DedicationsUpdateRequest;
use App\Http\Requests\Wr3\LetterNumeringRequest;
use App\Models\Wr3\Dedication;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;
use Storage;

class DedicationController extends Controller
{
    public function index()
    {
        if (Auth::user()->pengabdian()) {
            $search = request('search');
            $dedications = Dedication::query()
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%')
                            ->orWhere('funding_source', 'like', '%' . $search . '%')
                            ->orWhere('activity_schedule', 'like', '%' . $search . '%')
                            ->orWhere('location', 'like', '%' . $search . '%')
                            ->orWhere('participants', 'like', '%' . $search . '%')
                            ->orWhere('target_activity_outputs', 'like', '%' . $search . '%')
                            ->orWhere('public_media_publications', 'like', '%' . $search . '%')
                            ->orWhere('scientific_publications', 'like', '%' . $search . '%')
                            ->orWhere('members', 'like', '%' . $search . '%')
                            ->orWhereHas('humanResource', function ($query) use ($search) {
                                $query->where('sdm_name', 'like', '%' . $search . '%');
                            });
                    });
                })
                ->with('letterNumber')
                ->paginate(10);
            return view('wr3.dedication.index', compact('dedications', 'search'));
        }
    }

    public function byUser()
    {
        $search = request('search');
        $dedications = Dedication::query()
            ->whereSdmId(Auth::id())
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('funding_source', 'like', '%' . $search . '%')
                        ->orWhere('activity_schedule', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%')
                        ->orWhere('participants', 'like', '%' . $search . '%')
                        ->orWhere('target_activity_outputs', 'like', '%' . $search . '%')
                        ->orWhere('public_media_publications', 'like', '%' . $search . '%')
                        ->orWhere('scientific_publications', 'like', '%' . $search . '%')
                        ->orWhere('members', 'like', '%' . $search . '%')
                        ->orWhereHas('humanResource', function ($query) use ($search) {
                            $query->where('sdm_name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->with('letterNumber')
            ->paginate(10);
        return view('wr3.dedication.user', compact('dedications', 'search'));
    }

    public function create()
    {
        return view('wr3.dedication.create');
    }

    public function store(DedicationsRequest $request)
    {
        $proposal_file = FileHelper::upload($request, 'proposal_file', 'proposal_file');
        $validatedData = $request->validated();
        $validatedData['proposal_file'] = $proposal_file;
        $participants = $validatedData['participants'] ?? [];
        $validatedData['participants'] = json_encode($participants);
        Auth::user()->dedication()->create($validatedData);

        return redirect()->route('dedication.by-user')
            ->with('success', 'Dedication created successfully.');
    }

    public function edit(Dedication $dedication)
    {
        return view('wr3.dedication.edit', compact('dedication'));
    }

    public function update(DedicationsUpdateRequest $request, Dedication $dedication)
    {
        $updateForm = $request->validated();
        if ($request->hasFile('proposal_file')) {
            $proposal_file = FileHelper::upload($request, 'proposal_file', 'proposal_file');
            $updateForm['proposal_file'] = $proposal_file;
        } else {
            unset($updateForm['proposal_file']);
        }
        $dedication->update($updateForm);

        return redirect()->route('dedication.index')
            ->with('success', 'Dedication updated successfully.');
    }

    public function destroy(Dedication $dedication)
    {
        $dedication->delete();

        return redirect()->route('dedication.index')
            ->with('success', 'Dedication deleted successfully.');
    }

    public function formNumbering(Dedication $dedication)
    {
        return view('wr3.letter-number')
            ->with('route', route('dedication.letterNumbering', $dedication->id))
            ->with('letterNumber', $dedication->letterNumber);
    }

    public function letterNumbering(LetterNumeringRequest $request, Dedication $dedication)
    {
        $dedication->letterNumber()->updateOrCreate(['dedication_id' => $dedication->id], $request->validated());
        return redirect()->route('dedication.index')->with('success', 'Berhasil set nomor surat');
    }

    public function generateLetter(Dedication $dedication)
    {
        $kop = FileHelper::toBase64(public_path('kop-surat/pengabdian.png'));

        $values = [
            'number'     => $dedication->letterNumber->number,
            'month'      => $dedication->letterNumber->month,
            'year'       => $dedication->letterNumber->year,
            'activity'   => $dedication->activity,
            'participants'   => json_decode($dedication->participants),
            'as'         => $dedication->as,
            'theme'      => $dedication->theme,
            'date'       => DateHelper::formatTglId($dedication->activity_schedule, true),
            'location'   => $dedication->location,
            'updated_at' => DateHelper::formatTglId($dedication->letterNumber->updated_at, false)
        ];

        $pdf = Pdf::loadView('surat/surat-pengabdian', compact('kop', 'values'));
        return $pdf->download(Auth::user()->sdm_name . '.pdf');
    }
}
