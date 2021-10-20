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

mix.disableSuccessNotifications();

const sass = [
    "universidad.profesion",
    "header",
    "general",
    "post",
    "extranjero",
    "showcase-filter",
    "results",
    "becas",
    "profesion",
    "demas-noticias",
    "contact",
    "universidades",
    "university-card",
];
const js = ["profession-events", "universidades"];

sass.forEach(function (css) {
    mix.sass("resources/scss/" + css + ".scss", "public/css");
});

js.forEach(function (js) {
    mix.js("resources/js/" + js + ".js", "public/js");
});

if (mix.inProduction()) mix.version();
