@chart("pie",[
    [   
        "data"=>[
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"A",
                "backgroundColor"=>"rgb(255, 99, 132)"
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"B",
                "backgroundColor"=>"rgb(54, 162, 235)"
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"C",
                "backgroundColor"=>"rgb(255, 205, 86)"
            ]
        ]
    ]
],[
    "legend.display"=>true,
    "legend.position"=>"left",
    "title.display"=>true,
    "title.text"=>"Random pie chart",
    'borderWidth'=>5,
    'css_class'=>'border',
    "datalabels.display"=>false,
    
])