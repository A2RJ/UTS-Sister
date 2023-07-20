<?php

namespace App\Http\Controllers\Wr3;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wr3\DedicationsRequest;
use App\Http\Requests\Wr3\DedicationsUpdateRequest;
use App\Http\Requests\Wr3\LetterNumeringRequest;
use App\Models\Wr3\Dedication;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Auth;

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
        $request = $request->validated();
        $request['sdm_id'] = Auth::id();
        $request['proposal_file'] = $proposal_file;
        Dedication::create($request);

        return redirect()->route('dedication.index')
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
        $word = new PhpWord();
        $section = $word->addSection(array());
        $sectionStyle = $section->getStyle();
        $sectionStyle->setOrientation($sectionStyle::ORIENTATION_LANDSCAPE);

        // $table = $section->addTable(array());
        // $tableStyle = $table->getStyle();
        // $tableStyle->setStyleByArray(array(
        //     'borderColor' => '000000',
        //     'borderSize'  => 6,
        //     'cellMargin'  => 50,
        // ));
        // $tableStyle->setWidth($sectionStyle->getPageSizeW() - $sectionStyle->getMarginLeft() - $sectionStyle->getMarginRight());

        // $table->addRow();
        // $table->addCell(500)->addText('No.', ['bold' => true, 'fontSize' => 12], ['align' => 'center', 'spaceAfter' => 0]);
        // $table->addCell(3000)->addText('NAMA', ['bold' => true, 'fontSize' => 12], ['align' => 'center', 'spaceAfter' => 0]);
        // $table->addCell(3000)->addText('NIDN', ['bold' => true, 'fontSize' => 12], ['align' => 'center', 'spaceAfter' => 0]);
        // $table->addCell(4000)->addText('PROGRAM STUDI', ['bold' => true, 'fontSize' => 12], ['align' => 'center', 'spaceAfter' => 0]);

        // foreach ($researchAssignment->table as $index => $row) {
        //     $table->addRow();
        //     $table->addCell(500)->addText($index + 1, null, ['align' => 'left', 'spaceAfter' => 0]);
        //     $table->addCell(500)->addText($row['name'], null, ['align' => 'left', 'spaceAfter' => 0]);
        //     $table->addCell(3000)->addText($row['nidn'], null, ['align' => 'left', 'spaceAfter' => 0]);
        //     $table->addCell(3000)->addText($row['studyProgram'], null, ['align' => 'left', 'spaceAfter' => 0]);
        // }

        // $dateStart = $researchAssignment->dateStart;
        // $formatDateStart = Carbon::parse($dateStart);
        // $dateStart = $formatDateStart->locale('id_ID')->isoFormat('dddd, D MMMM YYYY');
        // $dateText = "pada hari $dateStart";

        // $dateEnd = $researchAssignment->dateEnd;
        // if ($dateEnd) {
        //     $formatDateEnd = Carbon::parse($dateEnd);
        //     $dateEnd = $formatDateEnd->locale('id_ID')->isoFormat('dddd, D MMMM YYYY');
        //     $dateText = "mulai $dateStart sampai $dateEnd";
        // }

        // $values = [
        //     'number' => $researchAssignment->number,
        //     'month' => $researchAssignment->month,
        //     'year' => $researchAssignment->year,
        //     'name' => $researchAssignment->user->sdm_name,
        //     'nidn' => $researchAssignment->user->nidn,
        //     'roles' => $researchAssignment->role,
        //     'activity' => $researchAssignment->activity,
        //     'as' => $researchAssignment->as,
        //     'theme' => $researchAssignment->theme,
        //     'date' => $dateText,
        //     'organizer' => $researchAssignment->organizer,
        //     'location' => $researchAssignment->location,
        // ];

        // $templatePath = Storage::path('../file/template.docx');
        // $template = new TemplateProcessor($templatePath);

        // $table->getStyle()->setStyleByArray($tableStyle);
        // $table->getStyle()->setAuto(false);
        // $table->getStyle()->setWidth(100);
        // $template->setComplexBlock('TABLE_BLOCK', $table);

        // foreach ($values as $key => $value) {
        //     $template->setValue($key, $value);
        // }

        // $outputPath = Storage::path('surat/' . $researchAssignment->user->sdm_name . '.docx');
        // $template->saveAs($outputPath);

        // return response()->download($outputPath)->deleteFileAfterSend();

        $values = [];
    }
}
