@chart("bubble",[
    [   
        "label"=> "Serie 1",
        "data"=>[
            [
                "data"=> [ 
                    "x"=>$faker->numberBetween(10,50),
                    "y"=>$faker->numberBetween(10,50),
                    "r"=>$faker->numberBetween(2,50)
                ]                               
            ],
            [
                "data"=> [ 
                    "x"=>$faker->numberBetween(10,50),
                    "y"=>$faker->numberBetween(10,50),
                    "r"=>$faker->numberBetween(2,50),
                ]                               
            ],  
            [
                "data"=> [ 
                    "x"=>$faker->numberBetween(10,50),
                    "y"=>$faker->numberBetween(10,50),
                    "r"=>$faker->numberBetween(2,50),
                ]                               
            ],          
            [
                "data"=> [ 
                    "x"=>$faker->numberBetween(10,50),
                    "y"=>$faker->numberBetween(10,50),
                    "r"=>$faker->numberBetween(2,50),
                ]                               
            ]
        ]

    ],
    [   
        "label"=> "Serie 2",
        "data"=>[
            [
                "data"=> [ 
                    "x"=>$faker->numberBetween(10,50),
                    "y"=>$faker->numberBetween(10,50),
                    "r"=>$faker->numberBetween(2,50),
                ]                               
            ],
            [
                "data"=> [ 
                    "x"=>$faker->numberBetween(10,50),
                    "y"=>$faker->numberBetween(10,50),
                    "r"=>$faker->numberBetween(2,50),
                ]                               
            ],  
            [
                "data"=> [ 
                    "x"=>$faker->numberBetween(10,50),
                    "y"=>$faker->numberBetween(10,50),
                    "r"=>$faker->numberBetween(2,50),
                ]                               
            ],          
            [
                "data"=> [ 
                    "x"=>$faker->numberBetween(10,50),
                    "y"=>$faker->numberBetween(10,50),
                    "r"=>$faker->numberBetween(2,50),
                ]                               
            ]
        ]

    ]
],[
    "legend.display"=>false,
    'css_class'=>'border',
    "title.display"=>true,
    "title.text"=>"Random Bubble chart",
    'prefix' => '$',
    'datalabels.font.weight'=>'bold',
    'datalabels.color'=>'#ffffff',
    'palette'=>'winter'
        
])