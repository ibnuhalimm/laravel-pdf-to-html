<?php

namespace Ibnuhalimm\LaravelPdfToHtml\Facades;

use Ibnuhalimm\LaravelPdfToHtml\LaravelPdfToHtml;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Ibnuhalimm\LaravelPdfToHtml\LaravelPdfToHtml
 *
 * @method static $this setFile(string $file)
 * @method static $this saveAs(string $filename)
 * @method static $this setConfig(array $attributes)
 * @method static string result()
 */
class PdfToHtml extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LaravelPdfToHtml::class;
    }
}
