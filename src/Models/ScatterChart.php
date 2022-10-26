<?php

namespace Ajtarragona\Charts\Models;


class ScatterChart extends BaseChart
{
    public $chart_type = "scatter";
    
    protected $options = [
        "datalabels.display" => false
    ];
    
}