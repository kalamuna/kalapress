<?php

/**
 * Included Functions Configuration Class File
 *
 * Provides a centralized place to manage the inclusion of function definitions
 * and other related PHP files within the theme that are not class based.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Config;

/**
 * Included Functions Configuration Class
 *
 * Manages the enablement and inclusion of PHP files that contain function definitions,
 * template tags, shortcodes, WooCommerce hooks and filters, and everything in between
 * that are not OOP within the theme.
 * Files can be dynamically included by listing them in the configuration array.
 * For each file, there should be a corresponding PHP file in the inc/ subdirectories.
 *
 * @package KLPTheme
 */
class IncludedFunctionsConfig {

	/**
	 * Retrieves the configuration array for included PHP files.
	 * Acts as a central location for managing which PHP files are included within the theme.
	 *
	 * Each key in the returned array represents a subdirectory within the inc/ directory,
	 * and the associated value is an array of file slugs (filenames without the .php extension)
	 * that should be included.
	 * Note that this does not include inc/post-types and inc/taxonomies subdirectories and
	 * those are handled separately via their own configuration files. So you do not need to list them here.
	 *
	 * @return array Associative array of subdirectories to an array of file slugs to include.
	 *
	 * @example To include the 'my-creatively-named-function.php' file from the 'functions' subdirectory,
	 * ensure the 'functions' key contains 'my-creatively-named-function' in its array.
	 *
	 * also make sure that the file is properly namespaced, and the function name is
	 * same as the file name with underscores instead of dashes.
	 * @example my-creatively-named-function.php should contain a function named my_creatively_named_function()
	 */
	public function get_included_files_configuration() {
		return [ 
			'template-tags' => [ 
				'get-display-custom-menu',
				'display-breadcrumbs',
				'display-entry-footer',
				'display-post-thumbnail',
				'display-posted-on',
				'display-posted-by',
				'display-favicons',
				'display-meta-tags',
			],
			'functions' => [ 
				'body-classes',
				'register-legacy-widget-areas',
				'register-block-pattern-categories',
				'cleanup-wordpress',
				'modify-max-srcset-image-width',
				'add-custom-image-sizes',
				'set-content-width',
			],
			'plugins' => [ 
				'acf-handle-get-block-wrapper-attributes',
				'yoast-remove-html-comments',
			],
			'shortcodes' => [
				// ...
			],
			'woocommerce' => [
				// ...
			],
			// Add other directories and files as needed
		];
	}
}
