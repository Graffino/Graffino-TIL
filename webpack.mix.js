let mix = require('laravel-mix');
let SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
let svgSpriteDestination = "../resources/views/layouts/svgs.blade.php";
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

mix.js('resources/assets/js/app.js', 'public/js')
mix.sass('resources/assets/sass/app.scss', 'public/css')
.webpackConfig({
    plugins: [
        new SVGSpritemapPlugin(['resources/assets/icons/*.svg'], {
            output: {
                chunk: { keep: true },
                svgo: {
                    removeTitle: true
                },
                filename: svgSpriteDestination
            },
        })
    ]
});

if (mix.inProduction()) {
    mix.version();
 }
