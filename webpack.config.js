
const Encore = require('@symfony/webpack-encore');
const Webpack = require('webpack');

const path = require('path');
Encore.reset();


Encore
    // the project directory where all compiled assets will be stored
    .setOutputPath(`./bundle/Resources/public/build/`)

    // the public path used by the web server to access the previous directory
    .setPublicPath(`/bundles/netgenibexafieldtypehtmltext/build`)

    .addEntry('app', `./bundle/Resources/js/app.js`)

    .setManifestKeyPrefix('build/')

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()
    .copyFiles([
        { from: './node_modules/ckeditor4/', to: 'ckeditor/[path][name].[ext]', pattern: /\.(js|css)$/, includeSubdirectories: false },
        { from: './node_modules/ckeditor4/adapters', to: 'ckeditor/adapters/[path][name].[ext]' },
        { from: './node_modules/ckeditor4/lang', to: 'ckeditor/lang/[path][name].[ext]' },
        { from: './node_modules/ckeditor4/plugins', to: 'ckeditor/plugins/[path][name].[ext]' },
        { from: './node_modules/ckeditor4/skins', to: 'ckeditor/skins/[path][name].[ext]' },
    ])

    .disableSingleRuntimeChunk()

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'entry';
        config.corejs = 3;
    });

const nghtmltextApp = Encore.getWebpackConfig();

nghtmltextApp.watchOptions = { poll: true, ignored: /node_modules/ };
nghtmltextApp.name = 'nghtmltext';

Encore.reset();

// export the final configuration
module.exports = [nghtmltextApp];

