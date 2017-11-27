let mix = require('laravel-mix');

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

mix.webpackConfig({
    resolve: {
        alias : {
            'select2' : 'select2/dist/js/select2.js'
        }
    }
});

mix.webpackConfig({
    resolve: {
        alias : {
            'select2-lang' : 'select2/dist/js/i18n/ru.js'
        }
    }
});

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

// mix.copy('node_modules/select2/dist/js/select2.js', 'public/js/modules');
// mix.copy('node_modules/select2/dist/css/select2.min.css', 'public/css');
mix.copy('node_modules/jquery-ui/ui/widgets/datepicker.js', 'public/js/modules');
mix.copy('node_modules/jquery-ui/ui/i18n/datepicker-ru.js', 'public/js/modules');
// mix.copy('node_modules/select2/dist/js/i18n/ru.js', 'public/js/modules');
mix.copy('node_modules/jquery-ui/themes/base/theme.css', 'public/css');
mix.copy('node_modules/jquery-ui/themes/base/datepicker.css', 'public/css');
mix.copy('node_modules/bootstrap-fileinput/css/fileinput.css', 'public/css');
mix.copy('node_modules/bootstrap-fileinput/js/locales/ru.js', 'public/js/locales/ru.js');
