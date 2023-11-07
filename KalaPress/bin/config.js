module.exports = {
  admin: {
    scriptsDir: 'admin',
    stylesDir: 'admin',
    outputDir: {
      scripts: 'admin/scripts',
      styles: 'admin/styles',
    },
    basePath: {
      scripts: 'src/js',
      styles: 'src/sass',
    },
  },
  editor: {
    scriptsDir: 'editor',
    stylesDir: 'editor',
    outputDir: {
      scripts: 'editor/scripts',
      styles: 'editor/styles',
    },
    basePath: {
      scripts: 'src/js',
      styles: 'src/sass',
    },
  },
  theme: {
    scriptsDir: 'theme',
    stylesDir: 'theme',
    outputDir: {
      scripts: 'theme/scripts',
      styles: 'theme/styles',
    },
    basePath: {
      scripts: 'src/js',
      styles: 'src/sass',
    },
  },
  // Add more configurations for new parent directories as needed
};
