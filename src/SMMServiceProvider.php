<?php

namespace Interpro\SMM;

use Illuminate\Support\ServiceProvider;
use Illuminate\Bus\Dispatcher;

class SMMServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Dispatcher $dispatcher)
    {
        //Publishes package config file to applications config folder
        $this->publishes([__DIR__.'/Laravel/config/smm.php' => config_path('smm.php')]);

        $dispatcher->maps([
            //'Interpro\SMM\Concept\Command\ExampleSMMCommand' => 'Interpro\SMM\Laravel\Handle\ExampleSMMCommandHandler@handle',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Interpro\SMM\Laravel\Http\SMMController');

        include __DIR__ . '/Laravel/Http/routes.php';
    }

}

