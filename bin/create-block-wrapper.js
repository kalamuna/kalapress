const { spawn } = require('child_process');
const fs = require('fs').promises;
const path = require('path');
const { code, info, success, error, fancy, warn } = require('./utils');
const templateConfig = require('./create-block-templates/acf/index');

/**
 * Helper function to check if a file exists
 *
 * @param {string} filePath - The path to the file
 * @returns {Promise<boolean>}
 * @throws {Error} - If the file access fails
 */
async function fileExists(filePath) {
  try {
    await fs.access(filePath);
    return true;
  } catch (e) {
    return false;
  }
}

/**
 * Renames a given file
 * Looks for the file in the given block directory and renames it
 *
 * @param {string} basePath - The base path for the file
 * @param {string} blockDir - The block directory
 * @param {string} oldFileName - The old file name
 * @param {string} newFileName - The new file name
 * @returns {Promise<void>}
 * @throws {Error} - If the file rename fails
  */
async function renameFile(basePath, blockDir, oldFileName, newFileName) {
  const oldFilePath = path.join(basePath, blockDir, oldFileName);
  const newFilePath = path.join(basePath, blockDir, newFileName);

  try {
    if (await fileExists(oldFilePath)) {
      await fs.rename(oldFilePath, newFilePath);
    } else {
      info(`\n${oldFilePath} not found, skipping rename.`);
    }
  } catch (error) {
    error(`\nError renaming file from ${oldFilePath} to ${newFilePath}:`, error);
    throw error; // Re-throw the error to be handled by the caller
  }
}

/**
 * Updates a key in block.json
 * Looks for the block.json file in the given block directory and updates the given key
 * with the given value
 *
 * @param {string} basePath - The base path for the file
 * @param {string} blockDir - The block directory
 * @param {string} keyPath - The key path to update
 * @param {string} newValue - The new value
 * @returns {Promise<void>}
 */
async function updateBlockJsonKey(basePath, blockDir, keyPath, newValue) {
  const blockJsonPath = path.join(basePath, blockDir, 'block.json');
  const blockJsonContent = await fs.readFile(blockJsonPath, 'utf8');
  let blockJson = JSON.parse(blockJsonContent);

  const keys = keyPath.split('.');
  let currentKey = blockJson;

  // Navigate through the nested structure
  for (let i = 0; i < keys.length; i++) {
    if (i === keys.length - 1) {
      // Only update if the final key exists
      if (currentKey.hasOwnProperty(keys[i])) {
        currentKey[keys[i]] = newValue;
        await fs.writeFile(blockJsonPath, JSON.stringify(blockJson, null, 2));
      } else {
        info(`\nIt seems that this block does not have `);
        warn(`${keyPath}`);
        info(` Skipping update...`);
      }
      break;
    } else {
      // Navigate to the next level in the structure
      if (currentKey.hasOwnProperty(keys[i])) {
        currentKey = currentKey[keys[i]];
      } else {
        info(`\nIt seems that this block does not have `);
        warn(`${keyPath}`);
        info(` Skipping update...`);
        break;
      }
    }
  }
}

/**
 * Configuration for updating block files
 * after the create-block package created files
 *
 * Add to this if we need to update more files and block.json keys
 *
 * @typedef {Object} UpdateConfig
 */
const updateConfig = [
  {
    type: 'file',
    oldName: 'style.scss',
    newName: blockDir => `${blockDir}.scss`
  },
  {
    type: 'file',
    oldName: 'index.js',
    newName: blockDir => `${blockDir}.js`
  },
  {
    type: 'file',
    oldName: 'view.js',
    newName: blockDir => `${blockDir}-view.js`
  },
  {
    type: 'blockJsonKey',
    keyPath: 'style',
    newValue: blockDir => [`file:./${blockDir}.css`]
  },
  {
    type: 'blockJsonKey',
    keyPath: 'script',
    newValue: blockDir => [`file:./${blockDir}.js`]
  },
  {
    type: 'blockJsonKey',
    keyPath: 'viewScript',
    newValue: blockDir => `file:./${blockDir}-view.js`
  },
  {
    type: 'blockJsonKey',
    keyPath: 'attributes.baseClass.default',
    newValue: blockDir => `kalapress-${blockDir}`
  }
];

/**
 * Updates the block files
 *
 * @param {string} basePath - The base path for the file
 * @param {string} blockDir - The block directory
 * @returns {Promise<void>}
 */
async function updateBlockFiles(basePath, blockDir) {
  for (const config of updateConfig) {
    if (config.type === 'file') {
      await renameFile(basePath, blockDir, config.oldName, config.newName(blockDir));
    } else if (config.type === 'blockJsonKey') {
      await updateBlockJsonKey(basePath, blockDir, config.keyPath, config.newValue(blockDir));
    }
  }
}

/**
 * Finds the most recent subdirectory in a given path
 * Since the create-block package uses slug for the block directory,
 * we can use the latest modified directory to determine the slug for the block
 *
 * @param {string} basePath - The base path for the file
 * @returns {Promise<string>} - The name of the most recent subdirectory
 */
async function findMostRecentSubdirectory(basePath) {
  let latestDir = null;
  let latestTime = 0;

  const entries = await fs.readdir(basePath, { withFileTypes: true });
  for (const entry of entries) {
    if (entry.isDirectory()) {
      const stat = await fs.stat(path.join(basePath, entry.name));
      if (stat.mtimeMs > latestTime) {
        latestTime = stat.mtimeMs;
        latestDir = entry.name;
      }
    }
  }

  return latestDir;
}

/**
 * Runs the create-block command
 *
 * @returns {Promise<void>}
 * @throws {Error} - If the command fails
 */
async function runCreateBlockCommand() {
  return new Promise((resolve, reject) => {
    const createBlockCommand = 'npx';
    const args = ['@wordpress/create-block', '--namespace', 'acf', '--template', templateConfig.blockTemplatesIndexPath, '--no-plugin', '--category', 'kalapress'];

    // Determine the path for block creation
    const execPath = path.join(process.cwd(), 'blocks/acf');
    warn('Executing command in:');
    code(`${execPath}\n`);

    const child = spawn(createBlockCommand, args, { stdio: 'inherit', shell: true, cwd: execPath });

    child.on('close', (code) => {
      if (code !== 0) {
        error(`Command failed with code ${code}`);
        return reject(`Command failed with code ${code}`);
      }
      resolve();
    });
  });
}

/**
 * Determines and executes the command
 *
 * @returns {Promise<void>}
 */
async function determineAndExecuteCommand() {
  try {
    fancy('Starting the block creation process...\n');
    await runCreateBlockCommand();

    const blocksBasePath = path.join(process.cwd(), 'blocks/acf/');
    const blockDir = await findMostRecentSubdirectory(blocksBasePath);

    info('\n------------------------');
    fancy(`\nPost block creation actions started for ${blockDir} block.`);
    info(`\nInspecting ${blockDir} block files...`);
    await updateBlockFiles(blocksBasePath, blockDir);

    success(`\n ${blockDir} block files have been successfully updated.`);
    info('');
    info(`Now Code is Poetry! ;)`);

  } catch (err) {
    error(`\nError: ${err}`);
  }
}

// Immediately-invoked async function
(async () => {
  await determineAndExecuteCommand();
})();
