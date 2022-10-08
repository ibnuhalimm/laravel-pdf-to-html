<?php

namespace Ibnuhalimm\LaravelPdfToHtml\Exceptions;

class InvalidFilename extends \Exception {
    public static function filename_not_allowed()
    {
        return new static('Filename should contains letters, numbers, and underscore only');
    }
}
