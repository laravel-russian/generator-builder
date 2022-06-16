<?php

namespace LaravelRussian\GeneratorBuilder;

use Illuminate\Support\ServiceProvider;
use LaravelRussian\GeneratorBuilder\Commands\GeneratorBuilderRoutesPublisherCommand;

class GeneratorBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/generator_builder.php';

        $this->publishes([
            $configPath => config_path('laravel-russian/generator_builder.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../views/', 'generator-builder');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravel-russian.publish.generator-builder', function ($app) {
            return new GeneratorBuilderRoutesPublisherCommand();
        });

        $this->commands([
            'laravel-russian.publish.generator-builder',
        ]);
    }
}
