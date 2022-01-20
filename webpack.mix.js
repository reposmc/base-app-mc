const mix = require("laravel-mix");

var WebpackObfuscator = require("webpack-obfuscator");

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

mix.js("resources/js/app.js", "public/js")
    .vue()
    .sass("resources/sass/app.scss", "public/css")
    .extract(["vue", "vuetify", "axios"])
    .options({
        processCssUrls: true,
    });

if (!mix.inProduction()) {
    mix.disableNotifications();
    mix.sourceMaps();
    mix.webpackConfig({
        devtool: "inline-source-map",
    });
} else {
    mix.webpackConfig({
        plugins: [
            new WebpackObfuscator(
                {
                    compact: true,
                    rotateStringArray: true,
                },
                ["app.js"]
            ),
        ],
    });
}
