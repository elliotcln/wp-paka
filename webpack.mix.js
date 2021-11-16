const mix = require('laravel-mix');

require('mix-tailwindcss');
require('dotenv').config();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your WordPlate applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JavaScript files.
 |
 */

const theme = process.env.WP_DEFAULT_THEME;

mix.setResourceRoot('../');
mix.setPublicPath(`public/themes/${theme}`);

mix.js('resources/scripts/app.js', 'assets/app.js')
  .sass('resources/styles/app.scss', 'style.css', [])
  .tailwind('./tailwind.config.js');;
