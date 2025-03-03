# Charts

Frontend package for the Charts generation library [ChartsJs](https://www.chartjs.org/)

[![Latest Stable Version](http://poser.pugx.org/ajtarragona/charts/v)](https://packagist.org/packages/ajtarragona/charts) [![Total Downloads](http://poser.pugx.org/ajtarragona/charts/downloads)](https://packagist.org/packages/ajtarragona/charts) [![Latest Unstable Version](http://poser.pugx.org/ajtarragona/charts/v/unstable)](https://packagist.org/packages/ajtarragona/charts) [![License](http://poser.pugx.org/ajtarragona/charts/license)](https://packagist.org/packages/ajtarragona/charts) [![PHP Version Require](http://poser.pugx.org/ajtarragona/charts/require/php)](https://packagist.org/packages/ajtarragona/charts)

## Instalació

```bash
composer require ajtarragona/charts:"@dev"
```

> **Important!!** Cada vegada que s'actualitzi el paquet, cal executar aquesta comanda per sobrescriure els assets (js i css)
```bash
php artisan ajtarragona:charts:assets
```


## Configuració

Pots publicar l'arxiu de configuració del paquet amb la comanda:

```bash
php artisan vendor:publish --tag=ajtarragona-charts-config
```

Això copiarà l'arxiu a `config/charts.php`.

Hi podries afegir més Paletes de colors.

#### Incloure els assets a la pantilla HTML
```html
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	...
    <link href="{{ asset('vendor/ajtarragona/css/charts.css') }}" rel="stylesheet">
	
</head>
<body>
    ...

    <script src="{{ asset('vendor/ajtarragona/js/charts.js')}}" language="JavaScript"></script>
	
</body>
</html>
```


#### Incloure a la capçalera el token CSRF i la url base
```html
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    ...
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="base-url" content="{{ url('') }}">
...
```


#### Inicialitzar els charts
Podem inicialitzar tots els que hi hagi carregats:
```html
<script language="JavaScript">
	$('.chart-canvas').tgnChart();
</script>
```	
O bé ho podem fer individualment a partir de l'ID:
```html
<script language="JavaScript">
	$('#demo-chart-1').tgnChart();
</script>
```	


## Ús

Podem crear gràfiques amb el component blade `@chart`
des de les nostres vistes.

Tenim dues opcions:

O bé passar una instància de `BaseChart` i un array d'opcions:<br/>
```bash
@chart($chart, $opcions=[])
```

> [Codi font d'exemples](https://github.com/ajtarragona/charts/tree/main/src/Models/Samples) 


O bé fer un chart dinàmic. Passant un string amb tipus de gràfica, els datasets i un array d'opcions:

```bash
@chart($tipus, $datasets, $opcions=[])
```

> [Codi font d'exemples](https://github.com/ajtarragona/charts/tree/main/src/resources/views/samples)


---


> Des de la teva aplicació, es pot accedir a una **DEMO** amb la ruta `ajtarragona/charts/samples`
>
> Podem deshabilitar la DEMO definint la variable `CHART_SAMPLES = false` a l'arxiu `.env` de l'aplicació (recomanable fer-ho en producció)
