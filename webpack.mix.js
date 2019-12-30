const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps();

mix.js('resources/js/admin/app.js', 'public/js/admin/')
.sass('resources/sass/admin/app.scss', 'public/css/admin');

mix.js('resources/js/blog/clean-blog.js', 'public/js/blog/')
.sass('resources/sass/blog/clean-blog.scss', 'public/css/blog/');
