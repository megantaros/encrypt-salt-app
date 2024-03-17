<?php

namespace App\Traits;

trait UploadFile
{
    public function uploadFile($file, $path)
    {
        // $storagePath = storage_path('app/public/' . $path);
        $storagePath = public_path('storage/' . $path);

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $fileName = time() . '.' . $file->getClientOriginalExtension();

        $file->move($storagePath, $fileName);

        return $fileName;
    }

    public function deleteFile($path, $fileName)
    {
        // $storagePath = storage_path('app/public/' . $path . '/' . $fileName);
        $storagePath = public_path('storage/' . $path . '/' . $fileName);

        if (file_exists($storagePath)) {
            unlink($storagePath);
        }
    }
}