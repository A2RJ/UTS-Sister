<?php

namespace App\Http\Controllers\Utils\File\Experiment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\Table;

class ExperimentWordController extends Controller
{
    public function index()
    {
        $headers = ['No.', 'Header 1', 'Header 2', 'Header 3'];
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

    public function v2()
    {
        $headers = ['No.', 'Header 1', 'Header 2', 'Header 3'];
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

        $table = $section->addTable([
            'width' => $sectionStyle->getPageSizeW() - $sectionStyle->getMarginLeft() - $sectionStyle->getMarginRight(),
            'borderSize'  => 6,
            'borderColor' => '000000',
            'cellMargin'  => 80,
            'alignment'   => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
            'layout'      => \PhpOffice\PhpWord\Style\Table::LAYOUT_FIXED,
        ]);

        $table->addRow();
        foreach ($headers as $detail) {
            $table->addCell(Converter::cmToTwip(4))->addText($detail, ['bold' => true], ['align' => 'left', 'spaceAfter' => 0]);
        }

        foreach ($body as $row) {
            $table->addRow();
            foreach ($row as $cell) {
                $table->addCell(Converter::cmToTwip(4))->addText($cell, null, ['align' => 'left', 'spaceAfter' => 0]);
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

        $outputPath = Storage::path('surat/test.docx');
        $template->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend();
    }
}
