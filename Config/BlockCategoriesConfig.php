<?php
/**
 * Block Categories Configuration Class File
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Config;

/**
 * Block Categories Configuration Class
 *
 * This class provides the configuration function for block categories.
 * It is used by the HandleBlockCategories class to add custom block categories.
 */
class BlockCategoriesConfig {

	/**
	 * Gets the configuration for block categories.
	 *
	 * Provides a configuration array for custom Gutenberg block categories.
	 * It defines an array structure where each element represents a category with its properties.
	 * Categories are used to group blocks within the Gutenberg editor.
	 *
	 * Usage:
	 * The configuration array should contain a list of categories, each as an associative array
	 * with required and optional keys. Required keys are 'slug' and 'title'. Optional keys
	 * include 'icon', 'on_top', and 'order'.
	 *
	 * 'slug' (string) [Required] Unique identifier for the category. Must be kebab-case.
	 * This is used to reference the category in the block registration.
	 *
	 * 'title' (string) [Required] A user-friendly name for the category. Localized using __().
	 *
	 * 'icon' (string) [Optional] Dashicons class name. Defaults to 'awards'.
	 *
	 * 'on_top' (bool) [Optional] Determines if the category should be placed at the top.
	 * Defaults to true.
	 *
	 * 'order' (int) [Optional] Determines the sort order when 'on_top' is the same across
	 * multiple categories. Lower numbers will be on top. Defaults to 10.
	 *
	 * Example:
	 * <code>
	 * [
	 *     [
	 *         'slug'   => 'our-slug',
	 *         'title'  => __( 'KLP Blocks', 'our-text-domain' ),
	 *         'icon'   => 'category',
	 *         'on_top' => true,
	 *         'order'  => 1,
	 *     ]
	 * ]
	 * </code>
	 *
	 * @return array The block categories configuration.
	 *
	 */
	public function get_block_categories_configuration() {
		return [
			[
				'slug'   => KLP_SLUG,
				'title'  => __( KLP_NAME, KLP_TXT_DOMAIN ),
				'on_top' => true,
				'order'  => 1,
			],
			// This is hypothetical, to show how to add a new category
			[
				'slug'   => KLP_SLUG . '-landing-pages',
				'title'  => __( 'Landing Pages', KLP_TXT_DOMAIN ),
				'icon'   => 'category',
				'on_top' => true,
				'order'  => 2,
			]
		];
	}
}
