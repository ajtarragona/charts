<?php

namespace Ajtarragona\Charts;

use Ajtarragona\Charts\Commands\SetupCharts;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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

        Blade::directive('chart', function($expression){
            return "<?php echo renderChart({$expression}); ?>";
        });

    }

    /**
     * Defines the boot configuration
     *
     * @return void
     */
    protected function bootConfig()
    {   
      

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
        
        $this->app['router']->aliasMiddleware('chart-samples', \Ajtarragona\Charts\Middlewares\ChartsSamplesMiddleware::class);

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
