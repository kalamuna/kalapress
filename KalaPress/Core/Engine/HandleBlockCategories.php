<?php
/**
 * Handle Block Categories Class File
 *
 * This class enhances the Gutenberg block editor by customizing block categories.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\BlockCategoriesConfig;
use KLPTheme\Core\Util\Logger;

/**
 * Handle Block Categories class.
 *
 * Manages the addition of custom block categories within the Gutenberg editor.
 * It leverages a configuration class as a dependency to load the categories.
 */
class HandleBlockCategories {

	/**
	 * Holds the block categories configuration.
	 *
	 * @var array
	 */
	private $categories_config;

	/**
	 * Class constructor.
	 *
	 * Initializes the class by setting up the block categories configuration.
	 *
	 * @param BlockCategoriesConfig $blockCategoriesConfig The configuration object for block categories.
	 */
	public function __construct( BlockCategoriesConfig $blockCategoriesConfig ) {
		$this->categories_config = $blockCategoriesConfig->get_block_categories_configuration();
		$this->hook();
	}

	/**
	 * Registers WordPress hooks.
	 *
	 * Adds a filter to modify all block categories within the editor.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/block_categories_all/
	 */
	private function hook() {
		add_filter( 'block_categories_all', [ $this, 'add_block_categories' ], 10, 2 );
	}

	public function add_block_categories( $block_categories, $block_editor_context ) {
		try {
			// Sort categories based on 'order' key inside the BlockCategoriesConfig
			usort( $this->categories_config, function ($a, $b) {
				return $b['order'] - $a['order'];
			} );

			foreach ( $this->categories_config as $category ) {
				$existingSlugs = array_column( $block_categories, 'slug' );
				if ( in_array( $category['slug'], $existingSlugs ) ) {
					continue;
				}

				$on_top = isset( $category['on_top'] ) ? $category['on_top'] : true;

				if ( ! isset( $category['icon'] ) ) {
					$category['icon'] = 'awards';
				}

				if ( $on_top ) {
					array_unshift( $block_categories, $category );
				} else {
					array_push( $block_categories, $category );
				}
			}

			return $block_categories;

		} catch (\Exception $e) {
			Logger::handleException( $e, true );
		}
	}
}
