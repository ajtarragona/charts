@chart("bar",[
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

    ],
    [   
        "label"=> "Serie 3",
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
        ]
    ]
],[
    "stacked"=>true,
    'horizontal'=>true,
    "legend.display"=>true,
    "title.display"=>true,
    "title.text"=>"Random Bar stacked chart",
    'css_class'=>'border',
    'borderWidth'=>0,
    "datalabels.color"=>'#333333',
    'palette'=>'green'

])