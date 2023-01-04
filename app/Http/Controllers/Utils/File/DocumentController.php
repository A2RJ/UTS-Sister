<?php

namespace App\Http\Controllers\Utils\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use PDF;
use setasign\Fpdi\Fpdi;

/**
 * Dari exel ke word
 * dari word ke pdf (masih gagal karena tidak bisa gambar sebagai background)
 */
class DocumentController extends Controller
{
    public function index()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText('Hello World!');
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('helloWorld.docx');
    }

    public function replaceWord()
    {
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/sertifikat.docx');

        $templateProcessor->setValue('certificateNumber', uniqid() . '-' . time());
        $templateProcessor->setValue('name', 'Doe');
        $templateProcessor->setValue('DOB', '12345678');
        $templateProcessor->setValue('title', 'Belajar jalani bersamamu, cakkep');
        $templateProcessor->setValue('date', Date('d-m-Y'));

        $templateProcessor->saveAs('ListSertifikat/my_new_document.docx');
    }

    public function convertToPdf()
    {
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        // $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('template/sertifikat.docx'));
        $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('template/newtamplate.docx'));
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        $PDFWriter->save(public_path('kedua' . uniqid() . '.pdf'));
        echo 'File has been successfully converted';
    }

    public function combinePdf()
    {
        $files = ['pertama.pdf', 'kedua.pdf'];
        $pdf = new Fpdi();

        foreach ($files as $file) {
            $pageCount =  $pdf->setSourceFile($file);
            for ($i = 0; $i < $pageCount; $i++) {
                $pdf->AddPage();
                $tplId = $pdf->importPage($i + 1);
                $pdf->useTemplate($tplId);
            }
        }
        return $pdf->Output();
    }
}
