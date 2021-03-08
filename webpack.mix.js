const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css').version()
   .js('resources/js/app.js', 'public/js')
     .extract(['lodash', 'axios', 'vue', 'jquery', 'popper.js', 'bootstrap'])
     .sourceMaps()
     .version();
