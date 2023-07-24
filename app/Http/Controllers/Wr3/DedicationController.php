<?php

namespace App\Http\Controllers\Wr3;

use App\Helpers\DateHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wr3\DedicationsRequest;
use App\Http\Requests\Wr3\DedicationsUpdateRequest;
use App\Http\Requests\Wr3\LetterNumeringRequest;
use App\Models\Wr3\Dedication;
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
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        //Load word file
        $templatePath = Storage::path('../file/template/surat-pengabdian.docx');
        $template = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
        // $template->setValue('role', $dedication->role);
        $outputPath = Storage::path('surat/' . date('Y') . '.docx');
        $template->saveAs($outputPath);

        $temp = \PhpOffice\PhpWord\IOFactory::load($outputPath);
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($temp, 'PDF');
        $PDFWriter->save(public_path('new-result.pdf'));
        echo 'File has been successfully converted';
        return response()->download($outputPath);
        // $template = new TemplateProcessor($templatePath);

        // $word = new PhpWord();
        // $section = $word->addSection(array('width' => 100));
        // $sectionStyle = $section->getStyle();
        // $sectionStyle->setOrientation($sectionStyle::ORIENTATION_LANDSCAPE);

        // $table = $section->addTable(array('width' => 100, 'indentation' => array('left' => 0, 'right' => 0)));
        // $table->getStyle()->setStyleByArray(array(
        //     'borderColor' => '000000',
        //     'borderSize'  => 6,
        //     'cellMargin'  => 50,
        //     'marginLeft'  => 0
        // ));
        // $table->getStyle()->setAuto(false);
        // $table->getStyle()->setWidth(100);

        // $fStyle = ['bold' => true, 'fontSize' => 12];
        // $pStyle = ['align' => 'center', 'spaceAfter' => 0];

        // $table->addRow();
        // $table->addCell(700)->addText('No.', $fStyle, $pStyle);
        // $table->addCell(2500)->addText('NAMA', $fStyle, $pStyle);
        // $table->addCell(2000)->addText('NIDN', $fStyle, $pStyle);
        // $table->addCell(2000)->addText('PROGRAM STUDI', $fStyle, $pStyle);
        // $table->addCell(2500)->addText('KETERANGAN', $fStyle, $pStyle);

        // $pStyle = ['align' => 'left', 'spaceAfter' => 0];

        // foreach (json_decode($dedication->participants) as $index => $row) {
        //     $table->addRow();
        //     $table->addCell(800)->addText($index + 1 . '.', null, $pStyle);
        //     $table->addCell(2500)->addText($row->name, null, $pStyle);
        //     $table->addCell(2000)->addText($row->nidn, null, $pStyle);
        //     $table->addCell(2000)->addText($row->studyProgram, null, $pStyle);
        //     $table->addCell(2500)->addText($row->studyProgram, null, $pStyle);
        // }

        // $template->setComplexBlock('TABLE_BLOCK', $table);

        // $values = [
        //     'number'     => $dedication->letterNumber->number,
        //     'month'      => $dedication->letterNumber->month,
        //     'year'       => $dedication->letterNumber->year,
        //     'name'       => $dedication->humanResource->sdm_name,
        //     'nidn'       => $dedication->humanResource->nidn,
        //     'role'       => $dedication->role,
        //     'as'         => $dedication->as,
        //     'activity'   => $dedication->activity,
        //     'theme'      => $dedication->theme,
        //     'date'       => DateHelper::format_tgl_id($dedication->activity_schedule, true),
        //     'location'   => $dedication->location,
        //     'updated_at' => DateHelper::format_tgl_id($dedication->letterNumber->updated_at, false)
        // ];

        // foreach ($values as $key => $value) {
        //     $template->setValue($key, $value);
        // }

        // $outputPath = Storage::path('surat/' . date('Y') . '.docx');
        // $template->saveAs($outputPath);
        // $domPdfPath = base_path('vendor/dompdf/dompdf');
        // \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        // \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        // $Content = \PhpOffice\PhpWord\IOFactory::load($outputPath);
        // $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        // // $PDFWriter->save(public_path('new.pdf'));
        // $PDFWriter->save(public_path('new.pdf'));
        // echo 'File has been successfully converted';
        // return response()->download($PDFWriter)->deleteFileAfterSend();
    }
}
