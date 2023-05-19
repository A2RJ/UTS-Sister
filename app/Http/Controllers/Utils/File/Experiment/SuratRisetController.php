<?php

namespace App\Http\Controllers\Utils\File\Experiment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\TblWidth;

class SuratRisetController extends Controller
{
    public function index()
    {
        $values = [
            'name' => 'ardi',
            'address' => 'Jl. sama kamu aja'
        ];

        $templatePath = Storage::path('surat/template/template.docx');
        $template = new TemplateProcessor($templatePath);

        foreach ($values as $key => $value) {
            $template->setValue($key, $value);
        }

        $filename = 'test.docx';
        $outputPath = Storage::path('surat/' . $filename);
        $template->saveAs($outputPath);
        return response()->download($outputPath)->deleteFileAfterSend();
    }

    public function v2()
    {
        $headers = ['Equipment Serial Number', 'yogatau', 'Applied Attesta Label Number', 'apalagi'];
        $body = [
            ['satu', 'satu', 'satu', 'apasih'],
            ['dua', 'dua', 'dua', 'gajelas']
        ];
        $table = $this->generateDynamicTable($headers, $body);

        $values = [
            'name' => 'ardi',
            'TABLE_BLOCK' =>  $table
        ];

        $templatePath = Storage::path('surat/template/template.docx');
        $template = new TemplateProcessor($templatePath);

        foreach ($values as $key => $value) {
            $template->setValue($key, $value);
        }

        $filename = 'test.docx';
        $outputPath = Storage::path('surat/' . $filename);
        $template->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend();
    }

    public function v3()
    {
        $headers = ['Header 1', 'Header 2', 'Header 3'];
        $body = [
            ['body 1', 'body 1', 'body 1'],
            ['body 2', 'body 2', 'body 2'],
            ['body 3', 'body 3', 'body 3'],
            ['body 4', 'body 4', 'body 4']
        ];

        $table = new Table(array('unit' => TblWidth::TWIP));
        $table->addRow();
        foreach ($headers as $detail) {
            $table->addCell(700)->addText($detail);
        }

        foreach ($body as $row) {
            $table->addRow();
            foreach ($row as $cell) {
                $table->addCell(700)->addText($cell);
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

        $filename = 'test.docx';
        $outputPath = Storage::path('surat/' . $filename);
        $template->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend();
    }

    public function v4()
    {
        $headers = ['Header 1', 'Header 2', 'Header 3'];
        $body = [
            ['body 1', 'body 1', 'body 1'],
            ['body 2', 'body 2', 'body 2'],
            ['body 3', 'body 3', 'body 3'],
            ['body 4', 'body 4', 'body 4']
        ];

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
        foreach ($headers as $detail) {
            $table->addCell(3500)->addText($detail, null, array('align' => 'left', 'spaceAfter' => 0));
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

    function generateDynamicTable($headers, $body)
    {
        $table = '<w:tbl><w:tblPr>' .
            '<w:tblStyle w:val="Grilledutableau"/>' .
            '<w:tblW w:w="0" w:type="auto"/>' .
            '<w:tblLook w:val="04A0" w:firstRow="1" w:lastRow="0" w:firstColumn="1" w:lastColumn="0" w:noHBand="0" w:noVBand="1"/>' .
            '<w:tblBorders>
                <w:top w:val="single" w:sz="4" w:space="0" w:color="auto"/>
                <w:left w:val="single" w:sz="4" w:space="0" w:color="auto"/>
                <w:bottom w:val="single" w:sz="4" w:space="0" w:color="auto"/>
                <w:right w:val="single" w:sz="4" w:space="0" w:color="auto"/>
                <w:insideH w:val="single" w:sz="4" w:space="0" w:color="auto"/>
                <w:insideV w:val="single" w:sz="4" w:space="0" w:color="auto"/>
            </w:tblBorders>' .
            '<w:shd w:val="clear" w:color="auto" w:fill="000000"/>' .
            '</w:tblPr><w:tblGrid>' .
            '<w:gridCol w:w="4675"/><w:gridCol w:w="4675"/></w:tblGrid>' .
            '<w:tr>';

        foreach ($headers as $col) {
            $table .=
                '<w:tc><w:tcPr><w:tcW w:w="4675" w:type="dxa"/></w:tcPr><w:p><w:t>' . $col . '</w:t></w:p></w:tc>';
        }

        $table .= '</w:tr>';
        foreach ($body as $row) {
            $table .= '<w:tr>';
            foreach ($row as $cell) {
                $table .= '<w:tc><w:tcPr><w:tcW w:w="4675" w:type="dxa"/></w:tcPr><w:p><w:t>' . $cell . '</w:t></w:p></w:tc>';
            }
            $table .= '</w:tr>';
        }
        $table .= '</w:tbl>';

        return $table;
    }
}
