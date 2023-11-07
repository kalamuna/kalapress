/* eslint-disable no-console */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );
const { getBuildMap } = require( './bin/utils' );

const scriptType = process.env.TYPE || '';
const subDir = process.env.SUBDIR || '';

const buildMap = getBuildMap();
const { dir, basePath, outputDir } = buildMap[ scriptType ] || {};

let folderPath;
let outputPath;

if ( subDir === '' ) {
  folderPath = `${ basePath }/${ dir }`;
  outputPath = `build/${ outputDir }`;
} else if ( dir && subDir ) {
  folderPath = `${ basePath }/${ dir }/${ subDir }`;
  outputPath = `build/${ outputDir }/${ subDir }`;
} else {
  folderPath = defaultConfig.entry;
  outputPath = 'build';
}

module.exports = {
  ...defaultConfig,
  entry: path.resolve( __dirname, folderPath, 'index.js' ),
  output: {
    ...defaultConfig.output,
    path: path.resolve( __dirname, outputPath ),
    filename: subDir ? `${ subDir }.js` : 'index.js',
    chunkFilename: '[name].js',
  },
};
