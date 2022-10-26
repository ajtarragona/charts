<?php

namespace Ajtarragona\Charts\Controllers;

use Ajtarragona\Charts\Models\Samples\DemoChart;
use Ajtarragona\Charts\Models\Samples\LinesAsyncChart;
use Ajtarragona\Charts\Models\Samples\PieAsyncChart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;
use Faker\Generator as Faker;


class ChartsController extends Controller
{

    public function samples(Faker $faker){ 
        $demochart=new DemoChart();
        $linesasyncchart = new LinesAsyncChart();
        $pieasyncchart = new PieAsyncChart();
        return view("charts::samples.welcome", compact('demochart','linesasyncchart','pieasyncchart','faker'));
    }


    public function loadChart(Request $request){
       
        try{ 
             // dd($request->all());
             // abort(500, "LALALAL");
             $classname=$request->classname;
             $options=$request->except(['classname','_token']);
             
             // laravel me cambia los puntos de las claves de los parametros por _
             $options=collect($options)->mapWithKeys(function ($item, $key) {
                 return [str_replace("_",".",$key) => $item];
             })->all();
             
 
             $chart=new $classname($options);
             $chart->reload();
 
             return response()->json([
                 "datasets"=>$chart->getDatasets(),
                 "options"=>$chart->getOptions()
             ]);
            
             
         }catch(Exception $e){
             return response()->json([
                 "message"=>$e->getMessage()
             ], 500);
         }
     }
}
