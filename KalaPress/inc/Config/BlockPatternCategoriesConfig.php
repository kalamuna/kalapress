<?php

/**
 * Block Pattern Categories Configuration Class File
 *
 * Provides management for custom block pattern categories used within the Gutenberg editor.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Config;

/**
 * Block Pattern Categories Configuration Class
 *
 * This class provides the configuration function for block pattern categories.
 *
 * @package KLPTheme
 */
class BlockPatternCategoriesConfig {

	/**
	 * Retrieves the custom block pattern categories configuration for the theme.
	 *
	 * This function returns an indexed array containing the configurations
	 * for each custom block pattern category that will be registered in the theme.
	 *
	 * @return array
	 * The configuration array of custom block pattern categories with details such as:
	 *
	 * - 'name' (string) Mandatory. A unique string that identifies the category.
	 * - 'label' (string) Mandatory. The display label for the block pattern category.
	 * - 'order' (int) Optional. Numeric order to display the categories. Defaults to the order in the array.
	 * - 'enable' (bool) Optional. Whether to enable or disable the category. Defaults to true.
	 *
	 * ## Structure of Return Array:
	 *
	 * - Each array element represents a custom block pattern category, containing:
	 *   - 'name': The slug for the category, prefixed with a unique theme identifier.
	 *   - 'label': The translated name that will appear in the editor.
	 *   - 'order': A number that determines the order in which categories will appear.
	 *   - 'enable': A boolean indicating whether the category is enabled.
	 * NOTE: 'order' and 'enable' added by HandleBlockPatternCategories class and are not part of the core WordPress core.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_pattern_category/
	 */
	public function get_custom_block_pattern_category_configuration() {
		return [
			[
				'name'   => KLP_SLUG,
				'label'  => __( KLP_NAME, 'kalapress' ),
				'order'  => 0,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-about',
				'label'  => __( 'About', 'kalapress' ),
				'order'  => 1,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-buttons',
				'label'  => __( 'Buttons', 'kalapress' ),
				'order'  => 2,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-call-to-action',
				'label'  => __( 'Call to Action', 'kalapress' ),
				'order'  => 3,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-columns',
				'label'  => __( 'Columns', 'kalapress' ),
				'order'  => 4,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-contact',
				'label'  => __( 'Contact', 'kalapress' ),
				'order'  => 5,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-embed',
				'label'  => __( 'Embed', 'kalapress' ),
				'order'  => 6,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-featured',
				'label'  => __( 'Featured', 'kalapress' ),
				'order'  => 7,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-footer',
				'label'  => __( 'Footer', 'kalapress' ),
				'order'  => 8,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-gallery',
				'label'  => __( 'Gallery', 'kalapress' ),
				'order'  => 9,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-header',
				'label'  => __( 'Header', 'kalapress' ),
				'order'  => 10,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-media',
				'label'  => __( 'Media', 'kalapress' ),
				'order'  => 11,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-portfolio',
				'label'  => __( 'Portfolio', 'kalapress' ),
				'order'  => 12,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-posts',
				'label'  => __( 'Posts', 'kalapress' ),
				'order'  => 13,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-query',
				'label'  => __( 'Query', 'kalapress' ),
				'order'  => 14,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-reusable',
				'label'  => __( 'Reusable', 'kalapress' ),
				'order'  => 15,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-services',
				'label'  => __( 'Services', 'kalapress' ),
				'order'  => 16,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-team',
				'label'  => __( 'Team', 'kalapress' ),
				'order'  => 17,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-testimonials',
				'label'  => __( 'Testimonials', 'kalapress' ),
				'order'  => 18,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-text',
				'label'  => __( 'Text', 'kalapress' ),
				'order'  => 19,
				'enable' => true
			],
			[
				'name'   => KLP_SLUG . '-widgets',
				'label'  => __( 'Widgets', 'kalapress' ),
				'order'  => 20,
				'enable' => true
			],
		];
	}

	/**
	 * Defines which core block pattern categories should be unregistered from the theme.
	 *
	 * This method returns an indexed array containing the slugs of core block pattern
	 * categories that should be removed from the theme. Since the WP core does not provide
	 * a streamlined way to control the order of core block pattern categories, we had to unregister
	 * them and re-register similar ones in the previous method (get_custom_block_pattern_category_configuration)
	 * to control the order of block pattern categories.
	 *
	 * @return array The indexed array of core block pattern category slugs to be unregistered.
	 *
	 * @see https://developer.wordpress.org/reference/functions/unregister_block_pattern_category/
	 */
	public function get_core_block_pattern_category_unregistration() {
		return [
			'featured',
			'query',
			'columns',
			'text',
			'posts',
			'call-to-action',
			'footer',
			'media',
			'portfolio',
			'about',
			'contact',
			'team',
			'testimonials',
			'services',
			'header',
			'gallery',
			'buttons',
		];
	}
}
