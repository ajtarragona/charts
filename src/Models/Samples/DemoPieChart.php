<?php

namespace Ajtarragona\Charts\Models\Samples;

use Ajtarragona\Charts\Models\DatasetValue;
use Ajtarragona\Charts\Models\LineChart;
use Ajtarragona\Charts\Models\PieChart;
use Ajtarragona\Charts\Traits\AsyncChart;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;


class DemoPieChart extends PieChart
{


    public $id = "demo_pie_chart";

    public $preloader = true;

    protected $palette = "default";

    protected $options = [
        'title.text' => "Demo async Pie chart",
        'title.display' => true,
        'legend.position' => 'left',
        'datalabels.color' => '#ffffff',
        'title.align' => 'start',
        'title.font.size' => '20pt',
        'aspectRatio' => 2
    ];




    public $refresh_rate = 3; //seconds

    public function __construct($options = [])
    {
        parent::__construct($options);

        $faker = FakerFactory::create();


        $pos = ["left", "right", "top", "bottom"];
        // dump($pos);
        $this->setOption('legend.position', $pos[array_rand($pos)]);

        $numseries = $faker->numberBetween(1, 3);

        for ($i = 0; $i < $numseries; $i++) {
            $dataset = $this->addDataset("Serie " . ($i + 1), null);
            $numdata = $faker->numberBetween(3, 8);

            for ($j = 0; $j < $numdata; $j++) {
                $this->addValueToDataset($dataset->id, "Opcio " . rand(1, 2) . "-" . ($j + 1), $faker->numberBetween(100, 300));
            }
        }
    }
}
