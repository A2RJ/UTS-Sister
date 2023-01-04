<?php

namespace App\Http\Controllers\Utils\File;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Rap2hpoutre\FastExcel\FastExcel;

use function PHPSTORM_META\map;

class ExelController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Hello from ExelController']);
    }

    public function import()
    {
        $file = public_path('exel/user.xlsx');

        $number = 1;
        $data = (new FastExcel)->import($file, function ($line) use (&$number) {
            $userTTL = User::where('nama', $line['Nama'])->where('tgl_lahir', '!=', '0000-00-00')->first();

            $tempat = '';
            $ttl = '';
            if ($userTTL) {
                $tempat = ucwords($userTTL->tempat);
                $ttl = Date::parse($userTTL->tgl_lahir)->format('d-m-Y');
            }

            return [
                'No' => $number++,
                'Nama' => $line['Nama'],
                'Tempat' => $tempat,
                'Tanggal Lahir' => $ttl,
                'NIM' => $line['NIM'],
                'Prodi' => $line['Program Studi'],
                'Skema' => $line['Skema'],
                'Tanggal Uji' => $line['Tanggal Uji'],
                'Nomor Sertifikat' => $line['Nomor Sertifikat'],
            ];
        });

        //  loop
        // foreach ($data as $key => $value) {
        //     if ($value['Tanggal Lahir'] === '30-11--0001') {
        //         echo $value['Nama'] . '<br>';
        //     }
        // }

        // skip 10th row
        // $data = collect($data)->skip(300);
        // $data = collect($data)->take(1);

        // $this->export($data);
        $this->createCertificates($data);
    }

    public function export($data)
    {
        (new FastExcel($data))->export('exel/DataWithDOB.xlsx');
    }

    public function createCertificates($data)
    {
        ini_set('max_execution_time', 1200);

        foreach ($data as $key => $value) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/pl.docx');

            $templateProcessor->setValue('certificateNumber', $value['Nomor Sertifikat']);
            $templateProcessor->setValue('name', $value['Nama']);

            $DOB = $value['Tanggal Lahir'] !== "0000-00-00" ? Date::parse($value['Tanggal Lahir'])->format('d-m-Y') : "";
            $templateProcessor->setValue('DOB', $value['Tempat'] . ', ' . $DOB);

            $templateProcessor->setValue('competence', $value['Skema']);
            $templateProcessor->setValue('issueddateid', $value['Tanggal Uji']);

            if ($value['Tanggal Uji'] === "25 Mei 2022") {
                $value['Tanggal Uji'] = "25 May 2022";
            } elseif ($value['Tanggal Uji'] === "30 Mei 2022") {
                $value['Tanggal Uji'] = "30 May 2022";
            } else {
                $value['Tanggal Uji'] = Date::parse($value['Tanggal Uji'])->format('d F Y');
            }

            $templateProcessor->setValue('issueddateen', $value['Tanggal Uji']);

            $templateProcessor->saveAs("pl/" . $value['Nama'] . ".docx");
        }
    }
}
