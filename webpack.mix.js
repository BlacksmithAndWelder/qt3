const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/welcome/welcome.js', 'public/js/welcome')
    .js('resources/js/nasa/detalhe.js', 'public/js/nasa')
    .js('resources/js/layout/main.js', 'public/js/layout')
    .js('resources/js/layout/componentes/modal.js', 'public/js/layout/componentes')
    .sass('resources/sass/layout/main.scss', 'public/css/layout')
    .sass('resources/sass/welcome/welcome.scss', 'public/css/welcome')
    .sass('resources/sass/nasa/detalhe.scss', 'public/css/nasa')
    .sass('resources/sass/app.scss', 'public/css');