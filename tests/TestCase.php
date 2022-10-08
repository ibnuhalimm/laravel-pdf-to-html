<?php

namespace Tests;

use Ibnuhalimm\LaravelPdfToHtml\Facades\PdfToHtml;
use Ibnuhalimm\LaravelPdfToHtml\PdfToHtmlServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            PdfToHtmlServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'PdfToHtml' => PdfToHtml::class
        ];
    }
}
