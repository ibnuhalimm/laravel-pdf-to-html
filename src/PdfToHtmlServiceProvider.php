<?php

namespace Ibnuhalimm\LaravelPdfToHtml;

use Ibnuhalimm\LaravelPdfToHtml\Facades\PdfToHtml;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class PdfToHtmlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-pdf-to-html.php'),
            ], 'laravel-pdf-to-html');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-pdf-to-html');

        $this->app->singleton(ConfigRepository::class, function() {
            return new ConfigRepository($this->app['config']['laravel-pdf-to-html']);
        });

        $this->app->singleton(Options::class, function (Application $app) {
            return new Options(
                $app->make(ConfigRepository::class)
            );
        });

        // Register the main class to use with the facade
        $this->app->bind(PdfToHtml::class, function (Application $app) {
            return new LaravelPdfToHtml(
                $app->make(ConfigRepository::class),
                $app->make(Options::class)
            );
        });
    }
}
