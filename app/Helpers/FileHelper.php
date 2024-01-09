<?php

namespace App\Helpers;

use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Mime\Encoder\Base64Encoder;

class FileHelper
{
    public static function uploadBatch(Request $request, array $files, string $folder = ''): array
    {
        try {
            $data = [];
            foreach ($files as $file) {
                $filename = self::upload($request, $file, $folder);
                $data[$file] = $filename;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function upload(Request $request, string $file, string $folder = ''): string
    {
        try {
            $uploadedFile = $request->file($file);
            if (!$uploadedFile) {
                throw new \Exception("File {$file} is required", 422);
            }
            $filename = $file . '_' . time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadFolder = $folder ?? $file;
            $uploadedFile->storeAs($uploadFolder, $filename);

            if (!Storage::disk('local')->exists($uploadFolder . '/' . $filename)) {
                throw new \Exception("Failed to upload file {$filename}", 500);
            }

            if ($uploadedFile->getSize() != Storage::disk('local')->size($uploadFolder . '/' . $filename)) {
                throw new \Exception("Failed to upload file {$filename}", 500);
            }

            return $filename;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function toBase64($pathToImage): string
    {
        $imageData = File::get($pathToImage);
        $base64Image = 'data:image/' . File::extension($pathToImage) . ';base64,' . base64_encode($imageData);
        return $base64Image;
    }
}
