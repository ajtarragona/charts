@chart("radar",[
    [   
        "data"=>[
            [
                "data"=>$faker->numberBetween(10,100),
                "label"=>"A"
            ],
            [
                "data"=>$faker->numberBetween(10,100),
                "label"=>"B"
            ],
            [
                "data"=>$faker->numberBetween(10,100),
                "label"=>"C"
            ],
            [
                "data"=>$faker->numberBetween(10,100),
                "label"=>"D"
            ]
        ],
        "borderColor"=>"rgb(255, 99, 132)",
        "backgroundColor"=>"rgba(255, 99, 132,0.4)"

    ],
    
    [   
        "data"=>[
            [
                "data"=>$faker->numberBetween(10,100),
                "label"=>"A"
            ],
            [
                "data"=>$faker->numberBetween(10,100),
                "label"=>"B"
            ],
            [
                "data"=>$faker->numberBetween(10,100),
                "label"=>"C"
            ],
            [
                "data"=>$faker->numberBetween(10,100),
                "label"=>"D"
            ]
        ],
        "borderColor"=>"rgb(54, 162, 235)",
        "backgroundColor"=>"rgba(54, 162, 235,0.4)"

    ],
],[
    "legend.display"=>false,
    "legend.position"=>"left",
    "title.display"=>true,
    "title.text"=>"Random radar chart",
    'css_class'=>'border',
    "aspectRatio"=>1,
    
    
])