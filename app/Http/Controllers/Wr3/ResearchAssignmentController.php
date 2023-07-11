<?php

namespace App\Http\Controllers\Wr3;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wr3\ResearchAssignment as ResearchAssignmentRequest;
use App\Models\ResearchAssignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ResearchAssignmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->rinov()) {
            return view('wr3.surat-tugas.index')
            ->with(
                'researchAssignments',
                ResearchAssignment::search()
                    ->with('user')
                    ->paginate()
            );
        }
        return back();
    }

    public function byUser()
    {
        return view('wr3.surat-tugas.index')
            ->with(
                'researchAssignments',
                ResearchAssignment::search()
                    ->with('user')
                    ->where('sdm_id', Auth::id())
                    ->paginate()
            );
    }

    public function create()
    {
        return view('wr3.surat-tugas.create');
    }

    public function store(ResearchAssignmentRequest $request)
    {
        $validated = $request->validated();
        $validated['sdm_id'] = Auth::id();

        ResearchAssignment::create($validated);
        return redirect()->route('wr3.research-assignment.by-user')->with('message', 'Berhasil input surat tugas');
    }

    public function edit(ResearchAssignment $researchAssignment)
    {
        if (Auth::user()->rinov()) {
            return view('wr3.surat-tugas.edit')
                ->with('researchAssignment', $researchAssignment);
        }
        return back();
    }

    public function update(Request $request, ResearchAssignment $researchAssignment)
    {
        if (Auth::user()->rinov()) {
            $validatedData = $request->validate([
                'number' => 'required|numeric',
                'month' => 'required|integer|min:1|max:12',
                'year' => 'required|numeric|digits:4',
            ], [
                'number.required' => 'Nomor harus diisi.',
                'number.numeric' => 'Nomor harus berupa angka.',
                'month.required' => 'Bulan harus diisi.',
                'month.integer' => 'Bulan harus berupa angka bulat.',
                'month.min' => 'Bulan harus di antara 1 dan 12.',
                'month.max' => 'Bulan harus di antara 1 dan 12.',
                'year.required' => 'Tahun harus diisi.',
                'year.numeric' => 'Tahun harus berupa angka.',
                'year.digits' => 'Tahun harus memiliki format empat angka, misalnya 2023.',
            ]);


            $researchAssignment->update($validatedData);
            return redirect()->route('wr3.research-assignment')->with('message', 'Berhasil menerima surat tugas');
        }

        return back();
    }

    public function changeStatus(ResearchAssignment $researchAssignment)
    {
        if (Auth::user()->rinov()) {
            $researchAssignment->status = !$researchAssignment->status;
            $researchAssignment->save();
            $researchAssignment->refresh();
            return back()->with('success', 'Berhasil terima atau tolak surat ' . $researchAssignment->user->sdm_name);
        }
        return back();
    }
    
    public function print(ResearchAssignment $researchAssignment)
    {
        $researchAssignment = $researchAssignment->where('sdm_id', Auth::id())->first();
        if ($researchAssignment) {
            return $this->suratTugas($researchAssignment);
        }
        return back();
    }

    public function destroy(ResearchAssignment $researchAssignment)
    {
        if ($researchAssignment->sdm_id == Auth::id()) {
            $researchAssignment->delete();
            return back()->with('success', 'Berhasil hapus surat');
        }
        return back()->with('success', 'Tidak dapat menghapus surat');
    }

    public function suratTugas($researchAssignment)
    {
        $word = new PhpWord();
        $section = $word->addSection(array());
        $sectionStyle = $section->getStyle();
        $sectionStyle->setOrientation($sectionStyle::ORIENTATION_LANDSCAPE);

        $table = $section->addTable(array());
        $tableStyle = $table->getStyle();
        $tableStyle->setStyleByArray(array(
            'borderColor' => '000000',
            'borderSize'  => 6,
            'cellMargin'  => 50,
        ));
        $tableStyle->setWidth($sectionStyle->getPageSizeW() - $sectionStyle->getMarginLeft() - $sectionStyle->getMarginRight());

        $table->addRow();
        $table->addCell(500)->addText('No.', ['bold' => true, 'fontSize' => 12], ['align' => 'center', 'spaceAfter' => 0]);
        $table->addCell(3000)->addText('NAMA', ['bold' => true, 'fontSize' => 12], ['align' => 'center', 'spaceAfter' => 0]);
        $table->addCell(3000)->addText('NIDN', ['bold' => true, 'fontSize' => 12], ['align' => 'center', 'spaceAfter' => 0]);
        $table->addCell(4000)->addText('PROGRAM STUDI', ['bold' => true, 'fontSize' => 12], ['align' => 'center', 'spaceAfter' => 0]);

        foreach ($researchAssignment->table as $index => $row) {
            $table->addRow();
            $table->addCell(500)->addText($index + 1, null, ['align' => 'left', 'spaceAfter' => 0]);
            $table->addCell(500)->addText($row['name'], null, ['align' => 'left', 'spaceAfter' => 0]);
            $table->addCell(3000)->addText($row['nidn'], null, ['align' => 'left', 'spaceAfter' => 0]);
            $table->addCell(3000)->addText($row['studyProgram'], null, ['align' => 'left', 'spaceAfter' => 0]);
        }

        $dateStart = $researchAssignment->dateStart;
        $formatDateStart = Carbon::parse($dateStart);
        $dateStart = $formatDateStart->locale('id_ID')->isoFormat('dddd, D MMMM YYYY');
        $dateText = "pada hari $dateStart";

        $dateEnd = $researchAssignment->dateEnd;
        if ($dateEnd) {
            $formatDateEnd = Carbon::parse($dateEnd);
            $dateEnd = $formatDateEnd->locale('id_ID')->isoFormat('dddd, D MMMM YYYY');
            $dateText = "mulai $dateStart sampai $dateEnd";
        }



        $values = [
            'number' => $researchAssignment->number,
            'month' => $researchAssignment->month,
            'year' => $researchAssignment->year,
            'name' => $researchAssignment->user->sdm_name,
            'nidn' => $researchAssignment->user->nidn,
            'roles' => $researchAssignment->role,
            'activity' => $researchAssignment->activity,
            'as' => $researchAssignment->as,
            'theme' => $researchAssignment->theme,
            'date' => $dateText,
            'organizer' => $researchAssignment->organizer,
            'location' => $researchAssignment->location,
        ];

        $templatePath = Storage::path('../file/template.docx');
        $template = new TemplateProcessor($templatePath);

        $table->getStyle()->setStyleByArray($tableStyle);
        $table->getStyle()->setAuto(false);
        $table->getStyle()->setWidth(100);
        $template->setComplexBlock('TABLE_BLOCK', $table);

        foreach ($values as $key => $value) {
            $template->setValue($key, $value);
        }

        $outputPath = Storage::path('surat/' . $researchAssignment->user->sdm_name . '.docx');
        $template->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend();
    }
}
