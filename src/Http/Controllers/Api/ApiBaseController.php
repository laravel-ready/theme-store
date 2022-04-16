<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Save a file to the storage.
     *
     * @param object $file
     * @param string $path
     * @param string $fileName
     * @return string
     */
    public function saveFileToDisk($file, $folder, $fileName): bool | string
    {
        $ext = $file->getClientOriginalExtension();
        $fullFilePath = "{$folder}/{$fileName}.{$ext}";
        $imageContent = file_get_contents($file->getRealPath());

        if (Storage::disk('theme_store')->exists($fullFilePath)) {
            Storage::disk('theme_store')->delete($fullFilePath);
        }

        return Storage::disk('theme_store')->put($fullFilePath, $imageContent) ? $fullFilePath : false;
    }

    public function deleteFileFromDisk($filePath): bool
    {
        if (Storage::disk('theme_store')->exists($filePath)) {
            return Storage::disk('theme_store')->delete($filePath);
        }

        return true;
    }
}
