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
    "layout.padding.right"=>40,
    "legend.display"=>true,
    "legend.position"=>"left",
    "title.display"=>true,
    "title.text"=>"Random pie chart",
    'borderWidth'=>5,
    'css_class'=>'border',
    "datalabels.labels.0.display"=>true,
    "datalabels.labels.0.anchor"=>"end",
    "datalabels.labels.0.align"=>"end",
    "datalabels.labels.0.color"=>"#ff0000",
    "datalabels.labels.0.content"=>"label",
    "datalabels.labels.0.font.size"=>"20pt",
    "datalabels.labels.1.display"=>true,
    "datalabels.labels.1.anchor"=>"center",
    "datalabels.labels.1.align"=>"center",
    "datalabels.labels.1.color"=>"#ffff00",
    "datalabels.labels.1.content"=>"value",
    "suffix"=>" €",
    
])