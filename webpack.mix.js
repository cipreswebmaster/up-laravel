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

mix.js("resources/js/app.js", "public/js").sass(
    "resources/scss/app.scss",
    "public/css"
);

const archivos = ["universidad.profesion.scss", "header.scss"];

archivos.forEach(function (el) {
    mix.sass("resources/scss/" + el, "public/css");
});

if (mix.inProduction()) mix.version();
