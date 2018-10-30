let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/pages/index.js', 'public/js/pages')
   .sass('resources/assets/sass/app.scss', 'public/css');

if (!mix.inProduction()) {
    mix.version();
}

// Moving vendor js files to public folder
mix.copy('node_modules/jquery/dist/jquery.js', 'public/js/vendor');