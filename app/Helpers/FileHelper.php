<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\Request;

class FileHelper
{
    public static function upload(Request $request, array|string $files, string $folder = ''): array|string
    {
        try {
            $data = [];
            if (is_array($files)) {
                foreach ($files as $file) {
                    $uploadedFile = $request->file($file);
                    if (!$uploadedFile)  throw new \Exception("File {$file} is required", 422);
                    $filename = $file . '_' . time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                    $uploadedFile->storeAs(($folder ? $folder : $file), $filename);
                    $data[$file] = $filename;
                }
            } elseif (is_string($files)) {
                $uploadedFile = $request->file($files);
                if (!$uploadedFile)  throw new \Exception("File {$files} is required", 422);
                $filename = $files . '_' . time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->storeAs(($folder ? $folder : $files), $filename);
                $data = $filename;
            } else {
                throw new \Exception("Invalid type for parameter upload 'files'. Array or string expected.", 422);
            }

            return $data;
        } catch (Exception $th) {
            throw $th;
        }
    }
}
