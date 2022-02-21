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

mix.babel('resources/js/welcome.js', 'public/js/welcome.js')
mix.babel('resources/js/auth.js', 'public/js/auth.js')
mix.babel('resources/js/dashboard.js', 'public/js/dashboard.js')
mix.babel('resources/js/post-slider.js', 'public/js/post-slider.js')
    .sass('resources/sass/main.scss', 'public/css', {
        sassOptions: {
            outputStyle: 'compressed',
        },
    })
    .version();
