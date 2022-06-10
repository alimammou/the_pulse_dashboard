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

mix.setPublicPath('public')
    .setResourceRoot('../') // Turns assets paths in css relative to css file
    .sass('resources/sass/frontend/app.scss', 'css/frontend.css')
    .sass('resources/sass/backend/app.scss', 'css/backend.css')
    .js('resources/js/frontend/app.js', 'js/frontend.js')
    .js([
        'resources/js/backend/before.js',
        'resources/js/backend/app.js',
        'resources/js/backend/after.js',
    ], 'js/backend.js')
    .js([
        'resources/js/frontend/network/index.js',
        'resources/js/frontend/network/polyfills.js',
    ], 'js/network.js')
    .copyDirectory('resources/sass/frontend/fonts', 'public/fonts')
    .copyDirectory('resources/sass/frontend/img', 'public/img')
    .copyDirectory('resources/sass/frontend/images', 'public/images')
    .extract([
        // Extract packages from node_modules to vendor.js
        'jquery',
        'bootstrap',
        'popper.js',
        'axios',
        'sweetalert2',
        'select2',
        '',
        'lodash',
        'datatables.net',
        'datatables.net-bs4',
        'moment',
        'moment-timezone',
        'eonasdan-bootstrap-datetimepicker-bootstrap4beta',
        'select2',
        // 'tinymce'
    ])
    .sourceMaps();

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);
module.exports = {
    //...
    experiments: {
        topLevelAwait: true
    },
};
if (mix.inProduction()) {
    mix.version()
        .options({
        // Optimize JS minification process
        terser: {
            cache: true,
            parallel: true,
            sourceMap: true
        }
    });
} else {
    // Uses inline source-maps on development
    mix.webpackConfig({
        devtool: 'inline-source-map',
        experiments: {
            topLevelAwait: true
        }
    });
}

