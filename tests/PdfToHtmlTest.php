<?php

namespace Tests;

use Ibnuhalimm\LaravelPdfToHtml\Exceptions\InvalidFilename;
use Ibnuhalimm\LaravelPdfToHtml\Exceptions\PdfNotFound;
use Ibnuhalimm\LaravelPdfToHtml\Facades\PdfToHtml;
use Illuminate\Foundation\Testing\WithFaker;

class PdfToHtmlTest extends TestCase
{
    use WithFaker;

    protected $dummyPdf = __DIR__ . '/testfiles/dummy_file.pdf';

    /** @test */
    public function it_should_be_throw_exception_if_file_is_not_readable()
    {
        $invalidPath = public_path('fake-pdf-file.pdf');

        $this->expectException(PdfNotFound::class);

        PdfToHtml::setFile($invalidPath)->result();
    }

    /** @test */
    public function it_can_save_as_result_file()
    {
        $saveFileAs = 'result_file_name';

        $result = PdfToHtml::setFile($this->dummyPdf)
            ->saveAs($saveFileAs)
            ->result();

        $resultFilename = basename($result);

        $this->assertEquals($resultFilename, $saveFileAs . '.html');
    }

    /** @test */
    public function it_should_throw_exception_if_invalid_save_filename()
    {
        $saveFileAs = 'contains_space ';
        $this->expectException(InvalidFilename::class);
        PdfToHtml::setFile($this->dummyPdf)
            ->saveAs($saveFileAs)
            ->result();


        $saveFileAs = 'has_dash-';
        $this->expectException(InvalidFilename::class);
        PdfToHtml::setFile($this->dummyPdf)
            ->saveAs($saveFileAs)
            ->result();
    }
}
