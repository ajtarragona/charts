
{{-- @dd($chart) --}}

<div class="chart-container {{$chart->container_class}}">
     <div class="preloader"><div></div><div></div></div>
     {{-- @dump($chart->getDatasets()) --}}
     <canvas 
          id="{{ $chart->_id() }}" 
          class="chart-canvas {{$chart->css_class}}" 
          data-type="{{$chart->chart_type}}" 
          data-async="{{$chart->isAsync()?"true":"false"}}"
          @if(!$chart->isAsync())
               
               data-datasets="{{json_encode($chart->getDatasets())}}"
          @else
               data-url="{{route('charts.chart')}}"
               data-preloader="{{ $chart->preloader?'true':'false' }}"
               data-options="{{ json_encode($chart->getOptionParams()) }}"
               data-classname="{{ get_class($chart) }}"
               data-refresh_rate="{{ $chart->refresh_rate }}"
          @endif

          data-options="{{json_encode($chart->getOptions())}}" 

          ></canvas>
</div>