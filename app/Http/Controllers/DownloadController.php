<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function presense($filename)
    {
        $file_path = 'attachments/' . $filename;

        if (Storage::disk('local')->exists($file_path)) {
            return Storage::download($file_path);
        } else {
            abort(404);
        }
    }

    public function meeting($filename)
    {
        $file_path = 'meetings/' . $filename;

        if (Storage::disk('local')->exists($file_path)) {
            return Storage::download($file_path);
        } else {
            abort(404);
        }
    }

    public function riset($filename)
    {
        $file_path = base64_decode($filename);

        if (Storage::disk('local')->exists($file_path)) {
            return Storage::download($file_path);
        } else {
            abort(404, "File Riset not found");
        }
    }

    public function pengabdian($filename)
    {
        $file_path = '/proposal_file/' . base64_decode($filename);

        if (Storage::disk('local')->exists($file_path)) {
            return Storage::download($file_path);
        } else {
            abort(404, "File Riset not found");
        }
    }
}
