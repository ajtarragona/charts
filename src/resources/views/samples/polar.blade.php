@chart("polarArea",[
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
            ]
        ]
    ]
],[
    "legend.display"=>true,
    "legend.position"=>"left",
    "title.display"=>true,
    'css_class'=>'border',
    "title.text"=>"Random polar chart",
    'borderWidth'=>5,
    "aspectRatio"=>1,
    // 'palette'=>'autumn'
    
])