require('laravel-mix-purgecss');

const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const fs = require('fs');
const path = require("path");

var themeFolder = '';

const publicJsFolder = 'public/js';

// mix.js('resources/js/app.js', publicJsFolder).then(() => {
//     mix.minify(`${publicJsFolder}/app.js`, `${publicJsFolder}/app.min.js`);
// });


//#region SASS Building

mix.sass(`./sass/web/store.scss`, 'public/web/css/store.min.css')
mix.sass(`./sass/web/error.scss`, 'public/web/css/error-style.min.css')
.options({
    processCssUrls: false,
    postCss: [ tailwindcss('./tailwind.config.js') ],
});

//#endregion
