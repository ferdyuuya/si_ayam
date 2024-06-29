const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .browserSync({
       proxy: 'localhost:8000',
       files: [
           'public/js/**/*.js',
           'public/css/**/*.css',
           'resources/views/**/*.php',
           'app/**/*.php',
           'routes/**/*.php'
       ],
       open: false,
   });
