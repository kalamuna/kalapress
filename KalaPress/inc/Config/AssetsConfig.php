<?php

namespace KLPTheme\Config;

/**
 * Assets configuration class
 *
 *
 */
class AssetsConfig {

	/**
	 * Generates the configuration array for enqueuing assets throughout the theme.
	 *
	 * This function returns an associative array containing the configuration
	 * for various assets such as scripts and styles for the theme, admin, and editor.
	 *
	 * @return array
	 * The configuration array detailing the assets to be enqueued in different sections
	 * such as 'theme', 'admin', and 'editor', each having its respective assets.
	 *
	 * ## Structure of Return Array:
	 *
	 *  * ### Location or Scope
	 *  - 'theme': For front-end theme assets.
	 *  - 'admin': For admin assets.
	 *  - 'editor': For block editor assets.
	 *
	 *  - each section having an array of assets, each represented by an associative array that contains the following keys:
	 * - 'type' (string) Mandatory. Specifies the type of the asset, either 'style' or 'script'.
	 * - 'handle' (string) Optional. A unique name for the asset. If not provided, the folder name is used.
	 * - 'file' (string) Mandatory. Relative path to the asset file from the theme root.
	 * - 'deps' (array) Optional. Array of registered handle names this asset depends on. Defaults to an empty array.
	 * - 'version' (string|bool|null) Optional. Version of the asset file. Defaults to filemtime of the asset file.
	 * - 'in_footer' (bool) Optional. Whether to enqueue the script in the footer. Defaults to true.
	 * - 'media' (string) Optional. Applicable for styles, specifies the media for which this stylesheet has been defined. Defaults to 'all'.
	 * - 'enqueue_callback' (callable) Optional. A callback function to conditionally load assets. Returns boolean.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 *
	 * ## Considerations and Best Practices:
	 * - Assets should ideally contain an .asset.php file specifying dependencies and versioning.
	 *
	 * - If built using standard WordPress build tools, .asset.php is auto-generated.
	 * - If not built, this file needs to be manually created by developers specifying dependencies and using filemtime for versioning.
	 * - Providing 'deps' and 'version' in the configuration array is not recommended as .asset.php has precedence.
	 * - 'enqueue_callback' can be utilized to load assets conditionally, based on requirements, to optimize performance.
	 *
	 * @example
	 * <code>
	 * function get_assets_configuration() {
	 *     return [
	 *         'theme' => [
	 *             [
	 *                 'type' => 'style',
	 *                 'handle' => 'theme-style',
	 *                 'file' => '/build/theme/style.css',
	 *                 'media' => 'all'
	 *             ],
	 *             [
	 *                 'type' => 'script',
	 *                 'handle' => 'theme-script',
	 *                 'file' => '/build/theme/script.js',
	 *                 'in_footer' => true,
	 *                 'enqueue_callback' => function() {
	 *                     return is_front_page() || is_singular('post');
	 *                 }
	 *             ]
	 *         ]
	 *     ];
	 * }
	 * </code>
	 */
	public function get_assets_configuration() {
		return [ 
			'theme'  => [ 
				[ 
					'type'   => 'style',
					'handle' => 'kalapress-styles',
					'file'   => '/build/theme/styles/style-main.css',
				],
				[ 
					'type'   => 'script',
					'handle' => 'kalapress-scripts',
					'file'   => '/build/theme/scripts/index.js',
				],
			],
			'admin'  => [ 
				[ 
					'type'   => 'style',
					'handle' => 'admin-general-styles',
					'file'   => '/build/admin/styles/general/main.css',
				],
				// for later use
				// [
				// 	'type'   => 'script',
				// 	'handle' => 'admin-general-scripts',
				// 	'file'   => '/build/admin/scripts/general/general.js',
				// ],
			],
			'editor' => [ 
				[ 
					'type'   => 'style',
					'handle' => 'editor-general-styles',
					'file'   => '/build/editor/styles/general/main.css',
				],
				[ 
					'type'   => 'script',
					'handle' => 'block-filters',
					'file'   => '/build/editor/scripts/block-filters/block-filters.js',
				],
				[ 
					'type'   => 'script',
					'handle' => 'format-toolbar-screen-reader-text',
					'file'   => '/build/editor/scripts/format-toolbar-screen-reader-text/format-toolbar-screen-reader-text.js',
				],
			],
		];
	}
}
