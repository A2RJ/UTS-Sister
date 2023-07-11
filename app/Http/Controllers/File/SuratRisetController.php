<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class SuratRisetController extends Controller
{
    public function index()
    {
        return 'TIDAK TAHU HARUS ADA APA';
    }

    public function export()
    {
        $headers = ['NO.', 'NAMA', 'NIDN', 'PROGRAM STUDI'];
        $body = [
            ['1', 'body 1', 'body 1', 'body 1'],
            ['2', 'body 2', 'body 2', 'body 2 lorem body 2 lorem body 2 lorem body 2 lorem body 2 lorem body 2 lorem body 2 lorem body 2 lorem '],
            ['3', 'body 3', 'body 3', 'body 3'],
            ['4', 'body 4', 'body 4', 'body 4']
        ];

        $word = new PhpWord();
        $section = $word->addSection([]);
        $sectionStyle = $section->getStyle();
        $sectionStyle->setOrientation($sectionStyle::ORIENTATION_LANDSCAPE);

        $table = $section->addTable([]);
        $tableStyle = $table->getStyle();
        $tableStyle->setStyleByArray(array(
            'borderColor' => '000000',
            'borderSize'  => 6,
        ));
        $tableStyle->setWidth($sectionStyle->getPageSizeW() - $sectionStyle->getMarginLeft() - $sectionStyle->getMarginRight());

        $table->addRow();
        foreach ($headers as $detail) {
            $table->addCell(3500)->addText($detail, ['bold' => true], array('align' => 'left', 'spaceAfter' => 0));
        }

        foreach ($body as $row) {
            $table->addRow();
            foreach ($row as $cell) {
                $table->addCell(3500)->addText($cell, null, array('align' => 'left', 'spaceAfter' => 0));
            }
        }

        $values = [
            'name' => 'ardi'
        ];

        $templatePath = Storage::path('surat/template/template.docx');
        $template = new TemplateProcessor($templatePath);

        $template->setComplexBlock('TABLE_BLOCK', $table);

        foreach ($values as $key => $value) {
            $template->setValue($key, $value);
        }

        $outputPath = Storage::path('surat/' . 'test.docx');
        $template->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend();
    }
}
