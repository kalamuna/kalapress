
# KalaPress

Kalamuna's WordPress Starter that is being used internally to spin up new projects quickly.

License: GPLv2 or later

License URI: <http://www.gnu.org/licenses/gpl-2.0.html>

Contributors: [Kalamuna](https://kalamuna.com)

## Table of Contents

1. **[Features](#-features)**
2. **[Comes Packed With](#-comes-packed-with)**
3. **[Rational](#-rational)**
4. **[Who is This For?](#-who-is-this-for)**
5. **[Before You Start](#-before-you-start)**
6. **[Getting Started](#-getting-started)**
7. **[ 🥋 Conventions](#-conventions)**
    - [NAMESPACE](#-namespace)
    - [space() function](#space-function)
    - [inc folder files](#inc-folder-files)
    - [Adding functionality to the theme](#adding-functionality-to-the-theme)
8. **[Config Folder](#-config-folder)**
    - [AssetsConfig.php](#-1-assetsconfigphp)
    - [BlockCategoriesConfig.php](#-2-blockcategoriesconfigphp)
    - [BlockPatternCategoriesConfig.php](#-3-blockpatterncategoriesconfigphp)
    - [BlocksConfig.php](#-4-blocksconfigphp)
    - [BlockStylesConfig.php](#-5-blockstylesconfigphp)
    - [IncludedFunctionsConfig.php](#-6-includedfunctionsconfigphp)
    - [PostTypesConfig.php](#-7-posttypesconfigphp)
    - [TaxonomiesConfig.php](#-8-taxonomiesconfigphp)
9.  **[Inc Folder Structure](#-inc-folder)**
    - [Post Types](#-1-incpost-types)
    - [Taxonomies](#-2-inctaxonomies)
    - [Functions](#-3-incfunctions)
    - [Template Tags](#-4-inctemplate-tags)
    - [Plugins Alterations](#-5-incplugins)
    - [Shortcodes](#-6-incshortcodes)
    - [WooCommerce](#-7-incwoocommerce)

## ✨ Features

- [x]  🔥 Hybrid approach to theme building which leverages the best of both worlds:

  modern classic PHP + Gutenberg blocks and templates

- [x]  💤 Easily builds and compiles the assets using [@wordpress/scripts](https://www.npmjs.com/package/@wordpress/scripts)

- [x]  📂 Sane, modular folder structure for assets, templates, and classes

- [x]  📦 Separate compilation of theme, editor, admin, and blocks CSS and JS, with the ability to toggle the enqueue of the built assets on/off

- [x]  👍 Composer autoloading for classes and namespaces across the files

- [x]  🔌 Dealing mostly with configuration files to turn stuff on or off

### 🎁 Comes packed with

- [x] Modern PHP
- [x] Modern CSS (SASS)
- [x] Modern JS (ES6+)
- [x] Modern tooling for compiling assets
- [ ] Linting
- [ ] Testing
- [ ] Extensive documentation
- [ ] Set of pre-made blocks
- [ ] Set of pre-made templates
- [ ] Set of pre-made patterns

## 🧠 Rational

***Work with WordPress, not against it.***

KalaPress serves as a starter hybrid theme for [Kalamuna](https://kalamuna.com)’s clients.
KalaPress is open source and built with the same tools that WordPress developers use every day:
Gutenberg, CSS/SASS, JavaScript, and HTML.
It is lightweight and as simple to maintain and use as possible, is easy to get started with, and compiles very quickly for everyday use.

Our thoughtful, integrated approach makes it easy to integrate unique branding into patterns, blocks, and elements that enhance the WordPress experience. This “Guided Design” approach to content development means the site can grow and evolve over time without losing what makes it unique. By leveraging the Gutenberg editor we can provide freedom and flexibility to front-line content entry people while ensuring the overall site remains consistent and on-brand.

## 📣 Who is this for?

❗**Intermediate to advanced-level** WordPress developers working either singly or as part of an agency.

Knowledge of SASS, NPM, and theme.json are helpful and to some extent necessary.

It is intended to be a starting point for easily building client-specific sites.

## 🔖 Before you start

KalaPress is provided on an **as-is basis** 🤷 in the state Kalamuna uses in their day-to-day workflow. It is a work in progress as standards and practices change. We provide it publicly as a service to the open source community but provide no guarantees or warranties for its use.

We are constantly working and contributing to this repo to make it as straightforward and easy to use and possible. If you have any questions or suggestions, please feel free to open an issue or submit a pull request.


⛔ You occasionally may find some redundant and non-working code in the theme.

We are working on cleaning it up and creating an extensive documentation for it. Note that this theme has been converted from a fully classic theme into a hybrid one with a more modern way of handling things. there are parts that are in place from the previous development efforts, and will be removed soon.

## 🚀 Getting Started

### ⚡️ Requirements

- WordPress >= **6.2.0**, tested up to **6.3.2**
- PHP >= **7.4**
- composer >= **2.0.0**
- node >= **16.0.0**
- Advanced Custom Fields >= **6.0**
    - NOTE: We use ACF Pro in our projects and love it. The theme currently uses ACF for some of its functionality. The public version of KalaPress is just born and we are converting from an older setup. This dependency will be removed in the future and made optional. For now, some parts will not work without ACF.

### ⚙️ Installation

KalaPress requires PHP & Composer to be installed, or you need to have a local environment that provides them for you like Lando, DDEV, Local by Flywheel, MAMP, XAMPP, etc. You also need Node and NPM installed.

1. Either download the ZIP file from the repo or clone it into your local wp-content/themes directory.

2. In the KalaPress folder, run `composer install`.
    - If you don't do that an admin notice in the WordPress dashboard will remind you to do so.
3. Choose & activate the theme in the WordPress Dashboard.

4. Once the theme is installed, the following sections describe how to monitor and compile the theme for use.

---

### 🥋 Conventions

#### ❗NAMESPACE

All of the files in the `inc`, `Core`, and `Config` directories as well as the `functions.php` file are and **MUST BE** namespaced.

#### ❗`space()` function

Returns the fully qualified name of the function and mostly used in add_action and add_filter like

```php
add_action( 'init', space( 'my_hooked_function_into_wp' ) );
```

This is a **MUST** to do any time when you want to hook into WordPress' actions and filters. Otherwise, you will get a fatal error something like

```txt
Fatal error: Uncaught Error: call_user_func_array(): Argument #1 ($callback) must be a valid callback
```

#### ❗inc folder files

Generally, it's recommended to have each .php file dedicated to a single function or action, and the name of the file should align with the function it contains, using hyphens instead of underscores in the file name.

So, as and example, if you have a function named `register_block_pattern_categories() {...}`, it should be placed in a file called `register-block-pattern-categories.php`, which is then stored in a suitable sub-directory within /inc.

#### ❗Adding functionality to the theme

When adding a new functionality or module (except blocks of course), in almost all other cases, they should reside inside the `/inc` directory and be namespaced.

This includes custom post types, taxonomies, template-tags, shortcodes, etc. The inc folder is structured for easy organization and maintenance. none of the files that are placed in the inc folder, are loaded by default and all of them must be mentioned inside the respective config classes in the `Config` directory.

### 📂 /Config folder

The `Config` folder, as the name suggests, contains all the configuration classes for the theme.

```console
Config/
├── AssetsConfig.php
├── BlockCategoriesConfig.php
├── BlockPatternCategoriesConfig.php
├── BlocksConfig.php
├── BlockStylesConfig.php
├── IncludedFunctionsConfig.php
├── PostTypesConfig.php
└── TaxonomiesConfig.php
```

#### 💠 1. AssetsConfig.php

This class is responsible for loading the theme's assets like CSS and JS files. It also has the ability to load the assets in the admin area and the editor area separately.

#### 💠 2. BlockCategoriesConfig.php

This class is responsible for registering the block categories in the editor. It also has the ability to re-order the block categories in the editor so that your custom categories appear at the top.

#### 💠 3.  ~~BlockPatternCategoriesConfig.php: This class is responsible for registering the block pattern categories in the editor.~~

This is under construction. for now use the `inc/functions/register-block-pattern-categories.php` file to register block pattern categories.

#### 💠 4. BlocksConfig.php

This class is responsible for including the **Custom** blocks in the editor. A block is not recognized by WordPress unless the name is mentioned in the config array in this class.

#### 💠 5. BlockStylesConfig.php

This class is responsible for including the block styles in the editor. Read the comments inside the class for more information.

#### 💠 6. IncludedFunctionsConfig.php

This class is responsible for loading the theme's included functions. It looks at the inc folder's sub-directories (except post-types and taxonomies) and loads the files inside them who are present in the array. Read the note below.

#### 💠 7. PostTypesConfig.php

This class is responsible for including the custom post types. There is a very important documentation inside the class that explains how to add a new post type. Please read that carefully.

#### 💠 8. TaxonomiesConfig.php

This class is responsible for including the custom taxonomies. There is a very important documentation inside the class that explains how to add a new taxonomy. Please read that carefully.

❕ **NOTE**:

When adding a new module or functionality in the `inc` directory, you need to mention that new file inside the respective config class.

For example, if you are adding a new custom post type, you need to mention that file inside the `PostTypesConfig` class inside the configuration array. This is how the theme knows about the new file and loads it.

❕ **NOTE**:

There is extensive documentation inside the `Config` classes that explains with examples how to that specific config class works. Please read those comments carefully.

As a todo item, we are working to add those comments to the documentation here as well.

### 📂 /inc folder

Here is where you put theme's essential PHP files, neatly categorized into different directories for efficient organization and easier maintenance. Each sub-directory serves a specific purpose:

#### 💠 1. inc/post-types/

Place your custom post type declarations here. Example files like faqs.php and team_member.php which define custom post types for FAQs and team members, respectively.

- You then go ahead and add the file name into the `PostTypesConfig` class inside the `Config` directory.
- Please carefully read the comments inside the `PostTypesConfig` class for more information.

#### 💠 2. inc/taxonomies/

This is where you define custom taxonomies. For instance, faq_types.php might contain definitions for different FAQ categories or types.

- You then go ahead and add the file name into the `TaxonomiesConfig` class inside the `Config` directory.
- Please carefully read the comments inside the `TaxonomiesConfig` class for more information.

#### 💠 3. inc/functions/

This directory contains PHP files for various theme functionalities. For example: `body-classes.php` for adding custom classes to the body tag.

- You then go ahead and add the file name into the `IncludedFunctionsConfig` class inside the `Config` directory.

#### 💠 4. inc/template-tags/

A collection of PHP functions used in your theme templates to keep your code DRY. These might include functions to display breadcrumbs, custom menus, post metadata, etc.

- You then go ahead and add the file name into the `IncludedFunctionsConfig` class inside the `Config` directory.

#### 💠 5. inc/plugins/

Use this to store any modifications or customizations related to plugins. start the file name with the plugin name and then add the functionality name. For example, `yoast-remove-page-source-comments.php` removes the source comments from the Yoast SEO plugin. Sticking to this naming convention will help you quickly find the file you need in the future.

- You then go ahead and add the file name into the `IncludedFunctionsConfig` class inside the `Config` directory.

#### 💠 6. inc/shortcodes/

Store any custom shortcode definitions in this directory (I mean if you are still using that). The .gitkeep file helps keep this directory in your repository even when no shortcodes are defined yet.

- You then go ahead and add the file name into the `IncludedFunctionsConfig` class inside the `Config` directory.

#### 💠 7. inc/woocommerce/

This directory is reserved for any WooCommerce-specific customizations or overrides. The .gitkeep file is there to keep the directory in your project until you add WooCommerce-related files.

- You then go ahead and add the file name into the `IncludedFunctionsConfig` class inside the `Config` directory.

#### 💠 8. inc/any-other-directory-that-makes-sense/

You can create any other directories that make sense for your project. For instance, you might create a directory called `inc/acf-fields/` to store your ACF field definitions.

- You then go ahead and add the file name into the `IncludedFunctionsConfig` class inside the `Config` directory.

```console
/inc
 ├── post-types
 │  ├── faqs.php
 │  └── team_member.php
 ├── taxonomies
 │  └── faq_types.php
 │  ├── ...
 │  └── ...
 ├── functions
 │  ├── body-classes.php
 │  ├── ...
 │  └── ...
 ├── template-tags
 │  ├── display-breadcrumbs.php
 │  └── display-posted-on.php
 ├── plugins
 │  ├── yoast-keep-metabox-collapsed.php
 │  ├── yoast-remove-page-source-comments.php
 │  ├── gravity-forms-add-signature-field.php
 │  └── ...
 ├── shortcodes
 │  └── .gitkeep
 └── woocommerce
    └── modify-checkout-fields.php
```

---

### Style Compilation

NPM is used to compile all SCSS, minify JS/CSS, and optimize images. Here are some helpful commands.

#### First Time Run

In the terminal, go to `/wp-content/themes/kalapress` and run `npm install`. This will install all the necessary node modules to do the various commands. You only need to do this once, when you first setup the theme in your local dev environment.

**Note**: This project is using node v16.

#### Watch Files

While you're working on SCSS, JS, and ACF Block files, you can run `npm run start` to auto compile any changes you've made. Browsersync should be supported.

#### Compile Files

To compile for production, you can run `npm run build` and it will place the compiled ACF Block files and Theme CSS and JS in the `/wp-content/themes/kalapress/build` folder.

### Adding custom blocks

#### ACF Blocks

Building blocks using Advanced Custom Fields Pro (ACF) is a fast and relatively simple method of creating custom Gutenberg blocks.
The main drawbacks to creating via this method are:
a) it’s not open source and is dependent on a paid plugin, and
b) the “Preview” in the editor doesn’t at all match the output, which can be confusing for users.

1. Create a new folder in blocks/acf with the name of your desired block, for instance `card--featured`
2. Create a file with the same name as the folder for rendering the contents, in this case `card--featured.php`
3. Create a `block.json` file in that new folder, with the relevant info filled out

```json
{
  "$schema": "https://schemas.wp.org/trunk/block.json%22,
  "apiVersion": 3,
  "name": "acf/card--featured",
  "title": "Kalamuna - Card Featured",
  "description": "Display a clickable block of content with a featured image, headline, and text.",
  "category": "theme",
  "icon": "images-alt2",
  "keywords": [
    "card",
    "featured"
  ],
  "acf": {
    "mode": "edit",
    "renderTemplate": "card--featured.php"
  },
  "example": "true",
  "supports": {
    "align": [
      "left",
      "right",
      "center"
    ],
    "spacing": {
      "margin": [
        "top",
        "bottom"
      ]
    }
  },
  "style": "file:./card--featured.css",
  "script": "file:./card--featured.js"
}

```

Note that `renderTemplate` will refer to the php file in the same folder.

4. Create an `.scss` file in the same folder with the same name, in this case `card--featured.scss`. Add a reference to this file in `block.json` so it gets imported via the “style” attribute as in the example.
5. Create a js file in the same folder with the same name, in this case `card--featured.js`. Add a reference to this file in `block.json` so it gets imported via the "script" attribute as in the example.
    1. Other values here can control which scripts (and styles) get loaded in the editor or the view only, see [Metadata in `block.json` | Block Editor Handbook | WordPress Developer Resources](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#script)
    2. The first line in the js file should import the scss file, like `import './card--featured.scss'`;
3. In Terminal, run `npm run build:blocks:acf` so the block is compiled and available in the CMS. If this fails, the most likely explanation is a comma at a line in `block.json` that doesn't have another attribute after it.
4. Create a Field Group in ACF with the required fields for your block, and output them in the render php file.

#### Adding a new Native Static block

1. In Terminal, make sure you are in the project root.
2. Type `npm add:block:static` and follow the prompts. The block will be added in the `blocks/native` directory.
3. Add a line to `inc/blocks-config.php` for your new block, like `'native/static'    => true` (be sure to add a comma to the end of the preceding line if there wasn't one)
4. When you’re ready to actually build the block, go to Terminal in the project root and start the build; in this case you’d probably want to use `npm run start:build:blocks:native` so you are only compiling the relevant parts of the theme and not the whole thing.

### Font Options

#### Font Size settings in theme.json

Font Sizes for our WordPress themes can be adjusted through the theme.json file under settings.typography.fontSizes.

There are three key/value pairs to look for:

- `slug`: the unique identifier used in the custom CSS variable.
- `size`: the CSS font-size value (preferably using the rem unit).
- `name`: the name that appears in the WordPress editor.

```json
{
  "settings": {
    "typography": {
      "fontSizes": [
        {
          "slug": "x-small",
          "size": "0.8rem",
          "name": "x-small"
        },
        {
          "slug": "small",
          "size": "0.875rem",
          "name": "small"
        },
        {
          "slug": "base",
          "size": "1rem",
          "name": "base"
        }
      ]
    }
  }
}
```

These font settings can then be referenced throughout the theme using their associated CSS variables:

- `var(--wp--preset--font-size--x-small)`
- `var(--wp--preset--font-size--small)`
- `var(--wp--preset--font-size--base)`

The font-size options in our themes typically range from: x-small, small, base, medium-small, medium, medium-large, large, x-large, xx-large, xxx-large.

In most cases, you'll only need to update the “size” values. If you need to add additional font-size options, try to keep the naming convention the same and place them in a sensical order within the fontSize array.

#### Fluid typography

Fluid typography responsively scales font sizes depending on the viewport width. This allows fonts to smoothly scale between minimum and maximum sizes.

By default, WordPress disables fluid typography, but we enable it in most of our themes. To see if fluid typography is enabled, look for these settings in `theme.json`:

```json
{
  "settings": {
    "typography": {
      "fluid": true
    }
  }
}
```

Once fluid typography is enabled, there are some additional settings that need to be added to your font size option.

- Inside "fluid", enter your `min` and `max` `font-size` values.
- `min`: the minimum font size. This is shown on viewports below 768px.
- `max`: The maximum font size. This is shown on viewports above 1600px.

```json
{
  "settings": {
    "typography": {
      "fontSizes": [
        {
          "slug": "xx-large",
          "size": "3rem",
          "name": "xx-large",
          "fluid": {
            "min": "2.25rem",
            "max": "3rem"
          }
        }
      ]
    }
  }
}
```

WordPress uses the clamp() function to resize your font-sizes based on the min and max values you enter. To read more about clamp() visit: [clamp() - CSS: Cascading Style Sheets | MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/clamp).

#### Disabling Fluid Typography

In some cases, you may want to disable fluid typography for a specific font option. To disable it, set the value for `fluid` to false like so:

```json
{
  "settings": {
    "typography": {
      "fontSizes": [
        {
          "slug": "xx-large",
          "size": "3rem",
          "name": "xx-large",
          "fluid": false
          }
        }
      ]
    }
  }
}
```

#### Font Styles in theme.json

##### Setting the default font size for your theme

To set the default font-size for your theme, enter a `fontSize` value under `styles.typography.fontSize`.

```json
{
  "styles": {
    "typography": {
      "fontSize": "var(--wp--preset--font-size--medium)",
    }
  }
}
```

These settings are outputted to the websites <body> tag like so:

```css
    body {
        font-size: var(--wp--preset--font-size--medium);
    }
```

#### Add font sizes to specific blocks

To add a font size to a specific block, enter a `fontSize` value under `styles.blocks.blockname.typography`. In the example below, we’re styling our buttons to use the large `font-size` option that we added to our settings.

```json
{
  "styles": {
    "blocks": {
      "core/button": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--large)"
        }
      }
    }
  }
}
```

When entering a `fontSize` value, any valid CSS value is accepted. However, it’s recommended to use one of the `fontSize` option presets that we have already added in our theme settings so that we can keep things consistent.

##### Disabling Font Options

We choose to disable many of the font options that WordPress enables by default. We do this to help keep the editor options within design restrictions.

An example of font options that we typically disable in `theme.json`:

```json
{
  "settings": {
    "typography": {
          "customFontSize": false,
            "dropCap": false,
            "lineHeight": false,
            "letterSpacing": false,
            "textDecoration": false,
            "fontStyle": false,
            "fontWeight": false,
    }
  }
}
```

### Layout & Spacing Options

#### Layout settings in theme.json

Container widths for our WordPress themes can be adjusted through the `theme.json` file. There are two key/value pairs to look for:

- `contentSize` sets the default width of the page container, blocks in the editor, and blocks in the front-end.
- `wideSize` activates the wide width feature and sets the width for wide blocks that extend past the page container.

**Theme.json Settings:**

```json
{
  "settings": {
    "layout": {
      "contentSize": "88.25rem",
      "wideSize": "91.5rem"
    }
  }
}
```

**Note**: It's recommended to use the `rem` unit when adding width values.

These settings can be referenced throughout the theme using their associated CSS variables:

- `var(--wp--style--global--content-size)`
- `var(--wp--style--global--wide-size)`

For KalaPress, we have leveraged these CSS variables for layout mixins and have assigned those styles to alignment utility classes.

**Available Mixins:**

- `@mixin container`
- `@mixin container--full`
- `@mixin container--wide`
- `@mixin container--narrow`

**Available utility classes:**

- `.alignfull` - Blocks can be set to Full width by selecting the option in the toolbar.
- `.alignwide` - Blocks can be set to Wide width by selecting the option in the toolbar.
- `.alignnarrow` - This is not a default WordPress utility class so it does not appear within the toolbar. We have added this class to accommodate narrow container sizes. Future scope: Add additional control to toolbar or register a block style.

**Spacing settings in theme.json**
By default, WordPress uses its own spacing scale. For KalaPress, we have created our own custom spacing scale to accommodate the Gutenberg editor.

In the editor sidebar under the Dimensions settings, users can choose from the x-small, small, medium, or large options to add padding or margins around blocks. This is beneficial for adding spacing between sections, for example:

![layout-spacing-1](https://github.com/kalamuna/kalapress-pro/assets/11493414/804dcc20-0cbb-4ca3-9ddf-80a90bf173e6)

*Example of a Medium bottom margin being applied to a block.
Note: Some blocks only support top and bottom margins.*

We have added four presets: X-Small, Small, Medium, and Large. Spacing sizes can be adjusted in `theme.json` under `settings.spacing.spacingSizes`.

Some of the sizes have been added using `clamp()` so that they are responsive. More information about the `clamp()` function: [clamp() - CSS: Cascading Style Sheets | MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/clamp). When entering new size values, it's recommended to use `rem` for the units.

**Theme.json Spacing Sizes Settings:**

```json
{
  "settings": {
    "spacing": {
      "spacingSizes": [
        {
          "size": "1.5rem",
          "slug": "x-small",
          "name": "X-Small"
        },
        {
          "size": "clamp(1.75rem, 6vw, 3rem)",
          "slug": "small",
          "name": "Small"
        },
        {
          "size": "clamp(2rem, 6vw, 6rem)",
          "slug": "medium",
          "name": "Medium"
        },
        {
          "size": "clamp(2rem, 8vw, 9rem)",
          "slug": "large",
          "name": "Large"
        }
      ]
    }
  }
}
```

#### Block Pattern Development

##### Adding margin and padding options directly to Block Patterns

If you apply margin or padding settings directly into your block pattern, the Dimensions option panel will expand and display your settings. Because there are options to change the padding and margin on all four sides of an element, applying your own settings can help guide the user on which margins/paddings should be changed for a specific block pattern.

![layout-spacing-2](https://github.com/kalamuna/kalapress-pro/assets/11493414/333a6e58-d47b-47e7-b42d-7ce533fe2b60)

*Example: this block pattern has margin settings applied to it. When it is inserted onto the page, the dimensions panel expands, and displays the margin settings.*

![layout-spacing-3](https://github.com/kalamuna/kalapress-pro/assets/11493414/fdaeb6fe-1b78-4078-be69-1341d931c1ce)

*Example: this block pattern does not have any margin or padding settings applied to it. Once added to the page, the Dimensions panel remains closed. In order to add spacing you must expand the panel and select margins/padding for each individual side.*

#### Disable Spacing settings for specific blocks

These spacing settings are available for all core blocks that support spacing. See [Core Blocks Reference | Block Editor Handbook | WordPress Developer Resources](https://developer.wordpress.org/block-editor/reference-guides/core-blocks/) to view which core blocks support padding and margins.

In some cases, you may not want to enable this feature, so there is an option to disable it for specific blocks. To disable, set `margin` or `padding` to `false` under `settings.blocks.core/block-name.spacing`

#### Theme.json settings for disabling spacing for core blocks

```json
{
  "settings": {
    "blocks": {
      "core/button": {
        "spacing": {
          "margin": false,
          "padding": false
        }
      }
    }
  }
}
```

### Color & Gradient Options

#### Theme Color settings in theme.json

The KalaPress theme color palette and gradients can be modified through the `theme.json` file under `settings.color.palette` and `settings.color.gradients`.

There are three key/value pairs to look for:

- `slug`: the unique identifier used in the custom CSS variable.
- `name`: the name that appears in the WordPress editor.
- `color` or `gradient`: The CSS color value.

#### Theme.json Color Slug naming

Instead of using color-specific slugs, we recommend using base, contrast, and sequential slugs like primary, secondary, tertiary, quaternary, etc.

- `base`: the background color.
- `contrast`: the color for elements on the page, ie. text, headings, lists, etc.
- `primary`, `secondary`, `tertiary`, etc: the accent colors.

This method promotes development with Global Styles in mind so that we can more efficiently adapt our themes to our client's brands.

The main colors for the website should be added through `theme.json`, but there are additional color variables available to use in `src/sass/settings/_color.scss`. These include: greyscale colors, lightened and darkened versions of the primary & secondary colors, etc.

Once you’ve added your color values to `theme.json`, it’s important to update the Brand Theme Color values in `src/sass/settings/_color.scss` as well.

#### Theme.json setting examples for palettes and gradients

```json
{
  "settings": {
    "color": {
      "palette": [
        {
          "slug": "base",
          "color": "#f2f2f2",
          "name": "Base (Light Grey)"
        },
        {
          "slug": "contrast",
          "color": "#191919",
          "name": "Contrast (Black)"
        }
        {
          "slug": "primary",
          "color": "#CE3C90",
          "name": "Primary (Pink)"
        },
        {
          "slug": "secondary",
          "color": "#323334",
          "name": "Secondary (Charcoal)"
        }
      ],
      "gradients": [
        {
          "slug": "primary-to-transparent",
          "gradient": "linear-gradient(180deg, var(--wp--preset--color--primary), rgba(255, 255, 255, 0))",
          "name": "Primary to Transparent"
        }
      ]
    }
  }
}
```

These color settings can then be referenced throughout the theme using their associated CSS variables. For example:

- `var(--wp--preset--color--primary)`
- `var(--wp--preset--gradient--primary-to-transparent)`

Additionally, new class names are created that reference these color variables. These class names are used within the block editor and front-end.

- background color class: `.has-primary-background-color`
- text color class: `.has-primary-color`
- gradient background color class: `.has-primary-to-transparent-gradient-background`

#### Adding color palettes and gradients for specific blocks

An example of what this would look like in the editor for the new color palette.
While the color variables from the previous steps are available to use across your entire theme, there is an option to add separate color palettes and gradients for individual blocks as well. This feature might be helpful if you want to limit a block to use certain colors and gradients.

- For color palettes, add your color values under: `settings.blocks.core/blockname.color.palette`.
- For gradients, add your gradient values under:  `settings.blocks.core/blockname.color.gradients`.
- Color palette and gradients added to a Button block in theme.json:

```json
{
  "settings": {
    "blocks": {
      "core/button": {
        "color": {
          "palette": [
            {
              "slug": "primary",
              "color": "#CE3C90",
              "name": "Primary (Pink)"
            },
            {
              "slug": "secondary",
              "color": "#323334",
              "name": "Secondary (Charcoal)"
            },
            {
              "slug": "base",
              "color": "#f2f2f2",
              "name": "Base (Light Grey)"
            }
          ],
          "gradients": [
            {
              "slug": "secondary-to-transparent",
              "gradient": "linear-gradient(0, var(--wp--preset--color--secondary) 0%, var(--wp--preset--color--primary-1) 100%)",
              "name": "secondary to Transparent"
            }
          ]
        }
      }
    }
  }
}
```

#### Disabling palettes and gradients for specific blocks

In some cases, you may want to disable the ability to change colors and gradients within a block. To do this, you would alter the properties like so:

```json
{
  "settings": {
    "blocks": {
      "core/paragraph": {
        "color": {
          "palette": [], // disables the color palette entirely.
          "gradients": [], // disables the gradients entirely.
          "background": false, // disables the ability to choose a bg color.
          "text": false, // disables the ability to choose a text color.
        }
      }
    }
  }
}
```

#### Disabling Theme Color and Gradient Options

We choose to disable many of the color and gradient options that WordPress enables by default. We do this to help keep the editor options within design restrictions.

An example of color options that we typically disable in `theme.json`:

```json
{
  "settings": {
    "color": {
      "custom": false,
      "customDuotone": false,
      "customGradient": false,
      "defaultDuotone": false,
      "defaultGradients": false,
      "defaultPalette": false
    }
  }
}
```
