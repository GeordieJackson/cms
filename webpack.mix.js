const mix = require('laravel-mix');

//require("laravel-mix-tailwind");

// SET UP VARIABLES
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var server_name = 'critical-thinking.test'
var path = ''
var server_port = 3000
var open_tab = true;
var browser = "/Applications/Firefox Developer Edition.app";
//var browser = "C:/Program Files/Firefox Developer Edition/firefox.exe";
//var browser = "chrome";
//var browser = 'firefox'
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


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

mix.js('resources/js/app.js', 'public/js').version()
    .js('resources/js/app-admin.js', 'public/js').version()
    .sass("resources/sass/style.scss", "public/css").version()
    //    .sass("resources/sass/icomoon.scss", "public/css")
    .sass('resources/sass/admin.scss', 'public/css').version()
    .sass('resources/sass/tinymce.scss', 'public/css')
//     .tailwind("./tailwind.config.js")
    .webpackConfig(require('./webpack.config'))
    .sourceMaps();

//mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');


mix.browserSync({
    proxy: server_name + path,
    port: server_port,
    browser: browser,
    open: open_tab,
});
