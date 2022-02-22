<?php

namespace Jbohme\LaravelEnvironmentSelector;

use Illuminate\Support\ServiceProvider;
use Jbohme\LaravelEnvironmentSelector\Commands\PublishSelector;

class LaravelEnvironmentSelectorProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            PublishSelector::class
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/env-selector.json' => base_path('env-selector.json')
        ], 'laravel-env-selector');
    }
}
