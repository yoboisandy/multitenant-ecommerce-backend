<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public static function uploadImage($file, $path = "/")
    {
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        }
        $data = $file;
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
        $extension = explode('/', $type)[1];

        // Handle SVG file extension
        if ($extension === 'svg+xml') {
            $extension = 'svg';
        }

        $fileName = time() . Str::random(10) . '.' . $extension;

        Storage::disk('public')->put($path . '/' . $fileName, $data);

        // give full url of image  if tenant then add tenant name in url
        return Storage::disk('public')->url($path . '/' . $fileName);
    }

    public static function deleteImage($file)
    {
        if ($file) {
            if (filter_var($file, FILTER_VALIDATE_URL)) {
                // check if $file is an external url then remove it
                $file = explode('storage/', $file)[1];
                if ($file && Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
        }

        return true;
    }

    public static function updateImage($file, $path, $oldFile)
    {
        if ($oldFile) {
            $oldFile = explode('storage/', $oldFile)[1];

            self::deleteImage($oldFile);
        }

        if (filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        }
        return self::uploadImage($file, $path ?? '/');
    }
}
