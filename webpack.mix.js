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

mix.copyDirectory('resources/js', 'public/js')
    .sass('resources/scss/main.sass', 'public/css')
    .copy('resources/css/all.min.css', 'public/css')
    .copyDirectory('resources/css/fonts', 'public/css/fonts')
    .copyDirectory('resources/img', 'public/img')