<?php

namespace App\Services;

class ImageService
{
    public static function upload($file, $path = "/")
    {
        if (substr($path, 0, 1) != "/") {
            $path = "/" . $path;
        }
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images' . $path), $fileName);

        return url('images' . $path . '/' . $fileName);
    }
}
