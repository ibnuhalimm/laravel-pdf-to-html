<?php

namespace Ibnuhalimm\LaravelPdfToHtml;

class FileManager {
    public function createDirectory(string $path)
    {
        if (!file_exists($path)) {
            mkdir($path);
        }
    }

    public function getPdfFilenameOnly(string $fullPath)
    {
        return basename($fullPath, '.pdf');
    }

    public function isFilenameAllowed(string $filename)
    {
        return preg_match('/^[a-zA-Z0-9_]+$/i', $filename);
    }
}
