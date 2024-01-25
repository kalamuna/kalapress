const { join } = require('path');

/**
 * @link https://github.com/WordPress/gutenberg/blob/trunk/packages/create-block/lib/init-block.js#L14
 */
module.exports = {
  blockTemplatesPath: join(__dirname, 'acf-templates'),
  blockTemplatesIndexPath: __dirname,
  defaultValues: {
    slug: 'kalapress-acf-block',
    title: 'KalaPress ACF Block',
    namespace: 'acf',
    category: 'kalapress',
    version: false,
    customBlockJSON: {
      textdomain: 'kalapress',
      acf: {
        'mode': 'preview',
        'renderTemplate': 'render.php',
      },
      attributes: {
        "baseClass": {
          "type": "string",
          "default": "kalapress-block-root-class"
        },
        supports: {
          "type": "object",
          "default": {
            "align": true,
            "anchor": true,
            "className": false,
            "customClassName": true,
            "html": false,
            "inserter": true,
            "multiple": true,
            "reusable": true
          }
        },
      },
      style: 'file:./index.css',
      script: 'file:./index.js',
    },
    editorStyle: false,
    editorScript: false,
    folderName: './src/blocks/acf/kalapress-block',
  },
  variants: {
    default: {},
    withViewScript: {
      viewScript: 'file:./view.js',
    },
    withEditorStyle: {
      editorStyle: 'file:./editor.css',
      editorScript: 'file:./editor.js',
    }
  }
};
