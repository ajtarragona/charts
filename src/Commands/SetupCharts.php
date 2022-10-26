<?php

namespace Ajtarragona\Charts\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class SetupCharts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ajtarragona:charts:assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish charts assets';

    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        
        
       Artisan::call('vendor:publish',['--tag'=>'ajtarragona-charts-assets','--force'=>true]);
        

        
        
        
    }

    


}
