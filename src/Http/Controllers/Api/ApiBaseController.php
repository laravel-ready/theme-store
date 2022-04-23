<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
    public function saveFileToDisk($file, $folder, $fileName, $type = 'public'): bool | string
    {
        $ext = $file->getClientOriginalExtension();
        $fullFilePath = "{$folder}/{$fileName}.{$ext}";
        $fileContent = file_get_contents($file->getRealPath());

        if (Storage::disk("theme_store_{$type}")->exists($fullFilePath)) {
            Storage::disk("theme_store_{$type}")->delete($fullFilePath);
        }

        return Storage::disk("theme_store_{$type}")->put($fullFilePath, $fileContent) ? $fullFilePath : false;
    }

    /**
     * Delete a file from the storage.
     *
     * @param string $filePath
     * @param string $type
     * @return bool
     */
    public function deleteFileFromDisk(string $filePath, string $type = 'public'): bool
    {
        if (Storage::disk("theme_store_{$type}")->exists($filePath)) {
            return Storage::disk("theme_store_{$type}")->delete($filePath);
        }

        return true;
    }

    /**
     * Get a file from the storage.
     *
     * @param string $filePath
     * @param string $type
     * @return string
     */
    public function getFileFromDisk(string $filePath, string $type = 'public'): string
    {
        if (Storage::disk("theme_store_{$type}")->exists($filePath)) {
            return Storage::disk("theme_store_{$type}")->get($filePath);
        }

        return '';
    }

    /**
     * Get a file from the storage.
     *
     * @param string $filePath
     * @param string $type
     * @return StreamedResponse
     */
    public function downloadFileFromDisk(string $filePath, string $type = 'public'): StreamedResponse
    {
        if (Storage::disk("theme_store_{$type}")->exists($filePath)) {
            return Storage::disk("theme_store_{$type}")->download($filePath);
        }

        // TODO: add exception
    }
}
