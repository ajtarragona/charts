<?php

namespace Ajtarragona\Charts;

use Illuminate\Support\ServiceProvider;

class ChartsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConfig();

        //vistas
        $this->loadViewsFrom(__DIR__.'/resources/views', 'charts');
        
        $this->loadRoutesFrom(__DIR__.'/routes.php');

         //idiomas
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'charts');

        $this->registerCommands();


    }

    /**
     * Defines the boot configuration
     *
     * @return void
     */
    protected function bootConfig()
    {   
        $base = __DIR__.'/Config/';
        $publish=[];

       //publico configuracion
       $config = __DIR__.'/Config/charts.php';
        
       $this->publishes([
           $config => config_path('charts.php'),
       ], 'ajtarragona-charts-config');


       $this->mergeConfigFrom($config, 'charts');


        //publico assets
       $this->publishes([
           __DIR__.'/public' => public_path('vendor/ajtarragona'),
       ], 'ajtarragona-charts-assets');
       
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
                
        //helpers
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }

    public function registerCommands()
    {
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupCharts::class,
            ]);
        }
    }
}
