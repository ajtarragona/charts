<?php

namespace Ajtarragona\Charts\Models;


class RadarChart extends BaseChart
{
    public $chart_type = "radar";
    
    protected $options = [
        "datalabels.display" => false
    ];
    
    
}