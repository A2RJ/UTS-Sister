<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function presense($filename)
    {
        $file_path = public_path('presense/attachments/' . $filename);

        if (file_exists($file_path)) {
            return response()->download($file_path);
        } else {
            abort(404);
        }
    }

    public function meeting($filename)
    {
        $file_path = public_path('presense/meetings/' . $filename);

        if (file_exists($file_path)) {
            return response()->download($file_path);
        } else {
            abort(404);
        }
    }
}
