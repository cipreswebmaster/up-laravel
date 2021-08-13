const mix = require("laravel-mix");

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

const archivos = ["universidad.profesion.scss", "header.scss", "general.scss"];

archivos.forEach(function (el) {
    mix.sass("resources/scss/" + el, "public/css");
});

if (mix.inProduction()) mix.version();
