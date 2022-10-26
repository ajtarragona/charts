@chart("doughnut",[
    [   
        "data"=>[
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"A",
                // "backgroundColor"=>"rgb(255, 99, 132)"
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"B",
                // "backgroundColor"=>"rgb(54, 162, 235)"
            ],
            [
                "data"=>$faker->numberBetween(10,300),
                "label"=>"C",
                // "backgroundColor"=>"rgb(255, 205, 86)"
            ]
        ]
    ]
],[
    // "legend.display"=>false,
    "title.display"=>true,
    "title.text"=>"Random donut chart",
    'cutout'=>'30%',
    'css_class'=>'border bg-dark',
    'id'=>'Chartdonut123',
    'title.color'=>'#ffffff',
    'borderColor'=>'#55595c',
    'legend.labels.color'=>'#ffffff',
    "suffix" =>"€",
    "palette"=>"winter"

])