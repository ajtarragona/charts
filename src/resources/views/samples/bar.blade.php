@chart("bar",[
    [   
        "label"=> "Serie 1",
        "data"=>[
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"1r T",
                'backgroundColor'=>'#ffff00'

            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"2n T",
                'backgroundColor'=>'#ff00ff',

            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"3r T",
                'backgroundColor'=>'#00ff00',
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"4t T",
                'backgroundColor'=>'#0000ff',

            ]
        ],
        'backgroundColor'=>'rgb(0, 0, 192)'

    ],
    [   
        "label"=> "Serie 2",
        "data"=>[
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"1r T",
                'backgroundColor'=>'#ffff00'

            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"2n T",
                'backgroundColor'=>'#ff00ff',

            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"3r T",
                'backgroundColor'=>'#00ff00',
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"4t T",
                'backgroundColor'=>'#0000ff',

            ]
        ],
        'backgroundColor'=>'rgb(0, 0, 192)'

    ]
],[
    "id"=>"bar-chart",
    "legend.display"=>false,
    "title.display"=>true,
    "title.text"=>"Random Bar chart",
    'borderWidth'=>0,
    'css_class'=>'border',
    "datalabels.color"=>'#333333',
    'suffix' => '%',
    // "tooltip.suffix"=>"%",
    // "tooltip.prefix"=>"$",
    "datalabels.display"=>true,
    // "datalabels.suffix"=>"%",
    "scales.x.title.display"=>true,
    "scales.x.title.text"=>"Trimestres",
    "scales.y.title.display"=>true,
    "scales.y.title.text"=>"Money",
    "scales.y.title.color"=>"red",
    "scales.x.title.color"=>"blue",
    'palette'=>'winter',
    'color_mode'=>'element'
    // "scales.y.ticks.suffix"=>"%",
    // "scales.x.ticks.prefix"=>"TRIMESTRE",
    

])