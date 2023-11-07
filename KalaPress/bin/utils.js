/* eslint-disable no-console */
const config = require( './config' );

function printHeader( commandType, scriptType, folderPath, outputPath ) {
  const arrowChar = '→';
  const borderChar = '─';
  const headerText = ` ${ arrowChar } Kalapress: ${
    commandType === 'build' ? 'Building...' : 'Watching...'
  } `;
  const borderColor = '\x1b[33m'; // Yellow
  const headerColor = '\x1b[30m\x1b[46m'; // Black text on Cyan background
  const labelColor = '\x1b[32m'; // Green
  const resetColor = '\x1b[0m'; // Reset color

  const fullBorder = borderChar.repeat( process.stdout.columns * 0.8 );

  console.log( borderColor + fullBorder + resetColor );
  console.log( headerColor + headerText + resetColor + '\n' );
  console.log( `${ labelColor }- Script Type:${ resetColor } ${ scriptType }` );
  console.log( `${ labelColor }- Source Path:${ resetColor } ${ folderPath }` );
  console.log( `${ labelColor }- Output Path:${ resetColor } ${ outputPath }` );
  console.log( borderColor + fullBorder + resetColor );
}

function getBuildMap() {
  const buildMap = {};
  Object.keys( config ).forEach( ( key ) => {
    const item = config[ key ];

    buildMap[ `${ key }:scripts` ] = {
      dir: item.scriptsDir,
      basePath: item.basePath.scripts,
      outputDir: item.outputDir.scripts,
    };

    buildMap[ `${ key }:styles` ] = {
      dir: item.stylesDir,
      basePath: item.basePath.styles,
      outputDir: item.outputDir.styles,
    };
  } );
  return buildMap;
}

module.exports = {
  printHeader,
  getBuildMap,
};
