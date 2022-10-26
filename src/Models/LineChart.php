<?php

namespace Ajtarragona\Charts\Models;


class LineChart extends BaseChart
{
    public $chart_type = "line";
    
    protected $options = [
        "datalabels.display" => false
    ];
    
   
    
}