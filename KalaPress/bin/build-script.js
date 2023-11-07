/* eslint-disable no-console */
const { spawn } = require( 'child_process' );
const path = require( 'path' );
const fs = require( 'fs' );
const config = require( './config' );
const { printHeader, getBuildMap } = require( './utils' );

const commandType = process.argv[ 2 ] || '';
const scriptType = process.argv[ 3 ] || '';
const subDirName = process.argv[ 4 ] || '';

const buildMap = getBuildMap();
const { dir, basePath } = buildMap[ scriptType ] || {};
const scriptTypePath = dir ? path.resolve( __dirname, '..', basePath, dir ) : null;

if ( commandType && scriptType && ( subDirName || scriptType === 'all' ) ) {
  let folderPath, outputPath, subDirs;

  if ( subDirName === 'current' ) {
    folderPath = `${ basePath }/${ dir }`;
    outputPath = `build/${ buildMap[ scriptType ].outputDir }`;
    subDirs = [ '' ]; // empty string to indicate the current directory

    // Check for the existence of index.js in the root of the directory
    if ( ! fs.existsSync( path.join( scriptTypePath, 'index.js' ) ) ) {
      console.error( `No index.js found in the root of ${ scriptTypePath }.` );
      process.exit( 1 );
    }
  } else {
    folderPath = dir && subDirName ? `${ basePath }/${ dir }/${ subDirName }` : 'N/A';
    outputPath =
      dir && subDirName ? `build/${ buildMap[ scriptType ].outputDir }/${ subDirName }` : 'N/A';

    if ( scriptType === 'all' ) {
      subDirs = Object.values( config ).flatMap( ( item ) => [ item.scriptsDir, item.stylesDir ] );
    } else if ( subDirName === 'all' ) {
      subDirs = fs
        .readdirSync( scriptTypePath )
        .filter( ( subDir ) => fs.statSync( path.join( scriptTypePath, subDir ) ).isDirectory() );

      // Check for entry points in all subdirectories
      const hasEntryPoints = subDirs.some( ( subDir ) =>
        fs.existsSync( path.join( scriptTypePath, subDir, 'index.js' ) ),
      );

      if ( ! hasEntryPoints ) {
        console.error( `No entry points found in any subdirectories of ${ scriptTypePath }.` );
        process.exit( 1 );
      }
    } else {
      subDirs = [ subDirName ];
    }
  }

  printHeader( commandType, scriptType, folderPath, outputPath );

  subDirs.forEach( ( subDir ) => {
    const entryPointPath = path.join( scriptTypePath, subDir, 'index.js' );

    if ( subDirName === 'all' && ! fs.existsSync( entryPointPath ) ) {
      console.error(
        '\x1b[31m',
        `No entry point found in ${ path.join( scriptTypePath, subDir ) }.`,
        '\x1b[0m',
      );
      return; // Skip this iteration, don't run the wp-scripts command
    }

    const command = `TYPE=${ scriptType } SUBDIR=${ subDir } wp-scripts ${ commandType } --config=kalapress.webpack.config.js`;
    const spawned = spawn( command, { shell: true, stdio: 'inherit' } );

    spawned.on( 'error', ( error ) => {
      console.error( `Error executing command: ${ error }` );
    } );

    spawned.on( 'close', ( code ) => {
      if ( code !== 0 ) console.error( `Process exited with code ${ code }` );
    } );
  } );
} else {
  console.error( 'Please provide a command type, a script type, and a subdirectory name or all' );
  process.exit( 1 );
}
