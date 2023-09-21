const Encore = require('@symfony/webpack-encore');
const path = require("path");

Encore.reset();

Encore
    // the project directory where all compiled assets will be stored
    .setOutputPath(`./bundle/Resources/public/build/`)

    // the public path used by the web server to access the previous directory
    .setPublicPath(`/bundles/netgenibexafieldtypehtmltext/build`)

    .addEntry('app', `./bundle/Resources/js/app.js`)
    .addEntry('admin_app', `./bundle/Resources/js/ibexa_admin.js`)

    .setManifestKeyPrefix('build/')

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    .disableSingleRuntimeChunk()

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'entry';
        config.corejs = 3;
    });

//
// Encore.addAliases({
//     '@ckeditor': path.resolve('./public/bundles/ibexaadminuiassets/vendors/@ckeditor'),
// });

const nghtmltextApp = Encore.getWebpackConfig();

nghtmltextApp.watchOptions = { poll: true, ignored: /node_modules/ };
nghtmltextApp.name = 'nghtmltext';

Encore.reset();

// export the final configuration
module.exports = [nghtmltextApp];

