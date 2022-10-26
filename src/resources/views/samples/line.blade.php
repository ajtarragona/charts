@chart("line",[
    [   
        "label"=> "Serie 1",
        "data"=>[
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"1r T",
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"2n T",
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"3r T",
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"4t T",
            ]
        ],
        "borderColor"=>chartColor(0),
        'backgroundColor'=>chartRGBAColor(0, 0.4),
        'fill' =>1,
        'pointStyle' => 'star',
        'pointRadius' =>10
    ],
    [   
        "label"=> "Serie 2",
        "data"=>[
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"1r T",
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"2n T",
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"3r T",
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"4t T",
            ]
        ],
        "borderColor"=>chartColor(1),
        // "tension"=> 0.2,
        'backgroundColor'=>chartRGBAColor(1, 0.4),
        'fill' =>'origin',
        'pointStyle' => 'triangle',
        'pointRadius' =>10



    ]
],[
    "legend.display"=>true,
    "legend.position"=>"left",
    "title.display"=>true,
    "title.text"=>"Random line chart",
    'borderWidth'=>3,
    "tension"=> 0.4,
    'css_class'=>'border',
    "tooltip.usePointStyle"=>true,
    "animations"=>[
        "tension" => [
            "duration" => 1000,
            "easing" => 'linear',
            "from" => 0.5,
            "to" => 0,
            "loop" => true
        ],
        "borderWidth" => [
            "duration" => 1000,
            "easing" => 'easeOut',
            "from" => 10,
            "to" => 1,
            "loop" => true
        ]
    ]
])