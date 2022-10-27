<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="base-url" content="{{ url('') }}">
	<meta name="lang" content="{{ app()->getLocale() }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="{{ asset('vendor/ajtarragona/css/charts.css') }}" rel="stylesheet">
	<style>
		#main-container{
			width:800px;
			margin-left:auto;
			margin-right:auto;
		}
		.row{
			display: flex;
		
		}
		.col{
			flex: 50%;
		}
		.border{
			border:1px solid #ccc;
		}
		.bg-dark{
			background-color:#667282;
		}
	</style>


	<title>Sample Charts</title>
</head>

<body>
	<div id="app">
		
		<main role="main" id="main-container">
		
			{{-- @dump($demochart) --}}
            @chart($demochart)
            @chart($linesasyncchart)
            @chart($pieasyncchart)

			<div class="row mb-3">
				<div class="col">
					@include('charts::samples.donut')
				</div>
				<div class="col">
					@include('charts::samples.pie')
				</div>
			</div>

			<div class="row">
				<div class="col">
					@include('charts::samples.polar')
				</div>
				<div class="col">
					@include('charts::samples.radar')
					
				</div>
			</div>

			@include('charts::samples.line')
			@include('charts::samples.bar')
			@include('charts::samples.bar_stacked')
			@include('charts::samples.bubble')
			@include('charts::samples.scatter')
				
				


		</main>
		

	</div>
	
	<script src="{{ asset('vendor/ajtarragona/js/charts.js')}}" language="JavaScript"></script>
	
	<script language="JavaScript">
		$('.chart-canvas').tgnChart();
	</script>
		

</body>
</html>