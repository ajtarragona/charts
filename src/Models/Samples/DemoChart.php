<?php

namespace Ajtarragona\Charts\Models\Samples;

use Ajtarragona\Charts\Models\LineChart;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;


class DemoChart extends LineChart
{   

    protected $palette="default";
    protected $color_mode="dataset";
    

    public $id="demo_chart";

    protected $options = [
        'title.text'=>"Demo chart",
        'title.display'=> true,
        'legend.position' =>'right',
        'legend.onClick'=>false,
        'datalabels.display'=>true,
        'tooltip.backgroundColor' => '#ffffff',
        'tooltip.bodyColor' => '#333333',
        'tooltip.titleColor' => '#666666',
        'tooltip.caretSize' => 0,
        'title.align'=>'start',
        'title.font.size'=>'20pt',
        'aspectRatio' => 2,
        "sortLabels" => ["Opcio 1","Opcio 3","Opcio 4","Opcio 6","Opcio 5","Opcio 2"]
    ];

 

    /**
     * Class constructor.
     */
    public function __construct($options=[])
    {
        parent::__construct($options);
        
        $faker = FakerFactory::create();
        $numseries=$faker->numberBetween(1,4);
        for($i=0;$i<$numseries; $i++){
            $numdata=$faker->numberBetween(3,8);
            
            $dataset=$this->addDataset("Serie " .($i+1), null, [
                // 'fill'=>'origin'
            ]);

            for($j=0;$j<$numdata; $j++){
                if($faker->numberBetween(1,2) == 2 )
                    $this->addValueToDataset($dataset->id, "Opcio ".($j+1), ["x"=> "Opcio ".($j+1), "y"=>$faker->numberBetween(100,300)]);
            }

        }
        // dd($this);
    }

}