let Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    .addPlugin(new CopyWebpackPlugin([
        {from: 'node_modules/@fortawesome/fontawesome-free/webfonts', to: 'webfonts'}
    ]))
    .addPlugin(new CopyWebpackPlugin([
        {from: 'node_modules/@fortawesome/fontawesome-free/svgs', to: 'svgs'}
    ]))
    .addPlugin(new CopyWebpackPlugin([
        {from: 'node_modules/@fortawesome/fontawesome-free/sprites', to: 'sprites'}
    ]))
    .addPlugin(new CopyWebpackPlugin([
        {from: './assets/images', to: 'images'}
    ]))
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())

    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    .autoProvidejQuery()
    .addEntry('js/app', [
        './assets/js/main.js'
    ])

    .addStyleEntry('css/app', './assets/css/app.scss')
    // uncomment if you use Sass/SCSS files
    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();
