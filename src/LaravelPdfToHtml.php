<?php

namespace Ibnuhalimm\LaravelPdfToHtml;

use Ibnuhalimm\LaravelPdfToHtml\Exceptions\CouldNotConvertPdf;
use Ibnuhalimm\LaravelPdfToHtml\Exceptions\InvalidFilename;
use Ibnuhalimm\LaravelPdfToHtml\Exceptions\PdfNotFound;
use Illuminate\Config\Repository as ConfigRepository;
use Symfony\Component\Process\Process;

class LaravelPdfToHtml
{
    /** @var \Illuminate\Config\Repository */
    protected $config;

    /** @var \Ibnuhalimm\LaravelPdfToHtml\Options */
    protected $options;

    /** @var string */
    protected $pdfFile;

    /** @var string */
    protected $outputFilename;

    /** @var int */
    protected $timeout = 60;

    /** @var \Ibnuhalimm\LaravelPdfToHtml\FileManager */
    protected $fileManager;

    /**
     * Create new instance.
     *
     * @param ConfigRepository $config
     * @return void
     */
    public function __construct(ConfigRepository $config, Options $options)
    {
        $this->config = $config;
        $this->options = $options;

        $this->fileManager = new FileManager();
    }

    /**
     * Override the default config.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function setConfig(array $attributes = []): LaravelPdfToHtml
    {
        foreach ($attributes as $key => $value) {
            if ($key == 'bin_path') {
                $this->config->set('bin_path', $value);
            } else if ($key == 'output_dir') {
                $this->config->set('output_dir', $value);
            } else if ($key == 'inline_image') {
                $this->config->set('inline_image', $value);
            }
        }

        $this->options = new Options($this->config->all());

        return $this;
    }

    /**
     * Set the PDF File.
     *
     * @param  string $file
     * @return $this
     * @throws PdfNotFound
     */
    public function setFile(string $file): LaravelPdfToHtml
    {
        if (!is_readable($file)) {
            throw new PdfNotFound("Could not read `{$file}` file");
        }

        $this->pdfFile = $file;
        return $this;
    }

    /**
     * Set filename result file
     *
     * @param  string  $filename
     * @return $this
     * @throws InvalidFilename
     */
    public function saveAs(string $filename)
    {
        if (!$this->fileManager->isFilenameAllowed($filename)) {
            throw InvalidFilename::filename_not_allowed();
        }

        $this->outputFilename = $filename;
        return $this;
    }

    /**
     * Set the timeout
     *
     * @param int $timeout
     * @return LaravelPdfToHtml
     */
    public function setTimeout(int $timeout): LaravelPdfToHtml
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Convert pdf to html and get the output file path
     *
     * @return string
     * @throws CouldNotConvertPdf
     */
    public function result()
    {
        $this->fileManager->createDirectory($this->config->get('output_dir'));
        $outputFilename = $this->outputFilename
            ? $this->outputFilename . '.html'
            : $this->fileManager->getPdfFilenameOnly($this->pdfFile) . '.html';

        $resultFile = $this->config->get('output_dir') . DIRECTORY_SEPARATOR . $outputFilename;

        $fulltextCommand = array_merge(
            [$this->config->get('bin_path')],
            $this->options->getAllOptions(),
            [$this->pdfFile],
            [$resultFile]
        );

        $process = new Process($fulltextCommand);
        $process->setTimeout($this->timeout);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new CouldNotConvertPdf($process);
        }

        return $resultFile;
    }
}
