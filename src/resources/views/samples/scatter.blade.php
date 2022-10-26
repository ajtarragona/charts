@php
    $numseries=2;
    $numdata=$faker->numberBetween(20,100);

    $datasets=[];
    for($i=0;$i<$numseries;$i++){
        $data=[];
        for($j=0;$j<$numdata;$j++){
            $data[]=
                [
                    "data"=> [ 
                        "x"=>$faker->numberBetween(10,50),
                        "y"=>$faker->numberBetween(10,50),
                    ]                               
                ];
        }
        $datasets[]=[
            "label"=> "Serie ".($i+1),
            "data" =>$data
        ];
    }
    // dump($datasets);
@endphp

@chart("scatter",$datasets,[
    "legend.display"=>true,
    "title.display"=>true,
    'css_class'=>'border',
    "title.text"=>"Random Scatter chart",
])