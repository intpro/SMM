<?php

namespace Interpro\SMM;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Bus\Dispatcher;
use Interpro\SMM\Laravel\FieldProviding\SMMFieldExtractor;
use Interpro\SMM\Laravel\FieldProviding\SMMFieldSaver;

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

        $this->publishes([
            __DIR__.'/Laravel/migrations' => $this->app->databasePath().'/migrations'
        ], 'migrations');

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
        $FExtMed = App::make('Interpro\QuickStorage\Concept\FieldProviding\FieldExtMediator');
        $FSaveMed = App::make('Interpro\QuickStorage\Concept\FieldProviding\FieldSaveMediator');

        $FE = new SMMFieldExtractor();
        $FS = new SMMFieldSaver();

        $FExtMed->addSuffix('smm', $FE);
        $FSaveMed->addSuffix('smm', $FS);

        $this->app->singleton(
            'Interpro\SMM\Concept\SMMRepository',
            'Interpro\SMM\Laravel\SMMRepository'
        );

        $this->app->make('Interpro\SMM\Laravel\Http\SMMController');

        include __DIR__ . '/Laravel/Http/routes.php';
    }

}
