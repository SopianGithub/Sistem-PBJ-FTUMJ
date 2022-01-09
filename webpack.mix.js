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

 mix.js('resources/js/app.js', 'public/js')
 .vue()
 .postCss('resources/css/app.css', 'public/css', [
     require('postcss-import'),
     require('tailwindcss'),
     require('autoprefixer'),
 ])
 .webpackConfig(require('./webpack.config'));

mix.options({
 hmrOptions: {
     host: '127.0.0.1',  // mysite.test is my local domain used for testing
     port: 8888,
 }
});

if (mix.inProduction()) {
 mix.version();
}
