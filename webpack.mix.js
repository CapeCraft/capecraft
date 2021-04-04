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

 mix.disableNotifications();

 mix.js("resources/js/app.js", "public/js").vue()
 mix.sass("resources/sass/app.scss", "public/css")
 mix.copyDirectory("resources/images", "public/images")

 /**
  * Add @ for gettign to root of directory
  */
 mix.webpackConfig({
     resolve: {
         extensions: ['.js', '.vue', '.json'],
         alias: {
             'vue$': 'vue/dist/vue.esm.js',
             '@': __dirname + '/resources/js',
         }
     }
     });

 if(mix.inProduction()) {
     mix.version();
 }