<?php

namespace App\Http\Controllers\Wr3;

use App\Http\Controllers\Controller;
use App\Models\ResearchAssignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ResearchAssignmentController extends Controller
{
    public function index()
    {
        return view('wr3.rinov.index-surat-tugas')
            ->with(
                'researchAssignments',
                ResearchAssignment::search()
                    ->with('user')
                    ->paginate()
            );
    }

    public function byUser()
    {
        return view('wr3.rinov.index-surat-tugas')
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
        return view('wr3.rinov.ajukan-surat-tugas');
    }

    public function update($researchAssignment)
    {
        if (auth()->user()->rinov()) {
            return view('wr3.rinov.terima-surat-tugas')
                ->with('researchAssignment', $researchAssignment);
        }
        return back();
    }

    public function changeStatus(ResearchAssignment $researchAssignment)
    {
        if (auth()->user()->rinov()) {
            $researchAssignment->status = !$researchAssignment->status;
            $researchAssignment->save();
            $researchAssignment->refresh();
            return back()->with('success', 'Berhasil terima tolak surat ' . $researchAssignment->user->sdm_name);
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

        $date = $researchAssignment->date;
        $formatDate = Carbon::parse($date);
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
            'date' => $formatDate->locale('id_ID')->isoFormat('dddd, D MMMM YYYY'),
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

        $outputPath = Storage::path('surat/' . 'test.docx');
        $template->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend();
    }
}
