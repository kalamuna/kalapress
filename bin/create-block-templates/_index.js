/**
 * External dependencies
 */
const { join } = require('path');

module.exports = {
  defaultValues: {
    slug: 'kalapress-example-block',
    category: 'kalapress',
    title: 'KalaPress Example Block',
    description: 'KalaPress Example Block',
    attributes: {},
    supports: {
      html: false,
    },
    customBlockJSON: {
      textdomain: 'kalapress',
    },
    namespace: 'native',
    wpScripts: false,
    wpEnv: false,
    version: false,
    folderName: './src/blocks/native/example-block',
    render: 'file:./render.php',
    editorStyle: false,
    style: 'file:./style.css',
  },
  variants: {
    default: {},
    innerBlocks: {},
    withViewScript: {
      viewScript: 'file:./view.js',
    },
  },
  blockTemplatesPath: join(__dirname, 'block-templates'),
};
