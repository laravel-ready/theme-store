<?php

namespace LaravelReady\ThemeStore\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Symfony\Component\HttpFoundation\StreamedResponse;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get a file from the storage.
     *
     * @param string $filePath
     * @param string $type
     * @return StreamedResponse
     */
    public function downloadFileFromDisk(string $filePath, string $fileName, string $type = 'public'): StreamedResponse
    {
        if (Storage::disk("theme_store_{$type}")->exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/zip, application/octet-stream',
            ];

            return Storage::disk("theme_store_{$type}")->download($filePath, $fileName, $headers);
        }

        // TODO: add exception
    }
}
