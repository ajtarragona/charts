let mix = require('laravel-mix');

mix.js('src/resources/assets/js/charts.js', 'src/public/js')
   .js('src/resources/assets/js/charts_vanilla.js', 'src/public/js')
   .sass('src/resources/assets/sass/charts.scss', 'src/public/css');
   