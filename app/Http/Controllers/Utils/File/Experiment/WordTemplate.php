<?php

namespace App\Http\Controllers\Utils\File\Experiment;

use App\Http\Controllers\Controller;
use PDF;

/**
 * Class WordTemplate
 * This class is not used anymore.
 * Just use DocumentController instead.
 */
class WordTemplate extends Controller
{
    public function index()
    {
        $file = public_path('surat_pernyataan.rtf');

        $array = array(
            '[NOMOR_SURAT]' => '015/BT/SK/V/2017',
            '[PERUSAHAAN]' => 'CV. Borneo Teknomedia',
            '[NAMA]' => 'Melani Malik',
            '[NIP]' => '6472065508XXXX',
            '[ALAMAT]' => 'Jl. Manunggal Gg. 8 Loa Bakung, Samarinda',
            '[PERMOHONAN]' => 'Permohonan pengurusan pembuatan NPWP',
            '[KOTA]' => 'Samarinda',
            '[DIRECTOR]' => 'Noviyanto Rahmadi',
            '[TANGGAL]' => date('d F Y'),
        );

        $nama_file = 'result.docx';
        $this->export($file, $array, $nama_file);
    }

    public function export($file = null, $replace = null, $filename = 'default.doc')
    {
        if (is_null($file))
            return response()->json(['error' => 'This method needs some parameters. Please check documentation.']);

        if (is_null($replace))
            return response()->json(['error' => 'This method needs some parameters. Please check documentation.']);

        $dokumen = $this->verify($file);

        foreach ($replace as $key => $value) {
            $dokumen = str_replace($key, $value, $dokumen);
        }

        header("Content-type: application/msword");
        header("Content-disposition: inline; filename={$filename}");
        header("Content-length: " . strlen($dokumen));

        // download
        // echo $dokumen;

        // save to public/files/
        $file_path = public_path($filename);
        file_put_contents($file_path, $dokumen);
        // return response()->download($file_path);
    }

    public function verify($file)
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $response = file_get_contents($file, false, stream_context_create($arrContextOptions));

        return $response;
    }

    public function convertToPdf($filename)
    {
        is_readable("result.docx") or die('File not found or not readable');
    }

    public function save($file = null, $replace = null, $filename = 'default.doc')
    {
        if (is_null($file))
            return response()->json(['error' => 'This method needs some parameters. Please check documentation.']);

        if (is_null($replace))
            return response()->json(['error' => 'This method needs some parameters. Please check documentation.']);

        $dokumen = $this->verify($file);

        foreach ($replace as $key => $value) {
            $dokumen = str_replace($key, $value, $dokumen);
        }

        $file = fopen($filename, 'w');
        fwrite($file, $dokumen);
        fclose($file);

        // convert to pdf
        // $this->convertToPdf($filename);

        return response()->json(['success' => 'File has been saved.']);
    }
}
