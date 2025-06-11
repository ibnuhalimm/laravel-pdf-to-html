<?php

namespace Ibnuhalimm\LaravelPdfToHtml;

use Illuminate\Config\Repository as ConfigRepository;

class Options {
    const COMPLEX_DOCUMENT = '-c';
    const NO_FRAMES = '-noframes';
    const DATA_URLS = '-dataurls';

    /**
     * @var ConfigRepository|array
     */
    protected $config;

    /**
     * @param  $config  ConfigRepository|array
     * @return void
     */
    public function __construct($config)
    {
        if ($config instanceof ConfigRepository) {
            $this->config = $config;
        } else if (is_array($config)) {
            $this->config = new ConfigRepository($config);
        }
    }

    /**
     * Get default options
     *
     * @return string[]
     */
    public function defaultOptions(): array
    {
        return [
          self::COMPLEX_DOCUMENT,
          self::NO_FRAMES
        ];
    }

    /**
     * Get -dataurls option
     *
     * @return string
     */
    public function imageTypeOption(): string
    {
        return $this->config->get('inline_images') ? self::DATA_URLS : '';
    }

    /**
     * Get all merged options
     *
     * @return string[]
     */
    public function getAllOptions(): array
    {
        $defaultOptions = $this->defaultOptions();
        array_push($defaultOptions, $this->imageTypeOption());

        return $defaultOptions;
    }
}
