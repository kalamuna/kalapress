<?php
/**
 * Handle Block Pattern Categories Class File
 *
 * Manages the customization of block pattern categories within the WordPress editor.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\BlockPatternCategoriesConfig;
use KLPTheme\Core\Util\Logger;

/**
 * Class HandleBlockPatternCategories
 *
 * Manages the customization of block pattern categories within the WordPress editor.
 * It leverages a configuration class as a dependency to load the categories.
 *
 * @package KLPTheme
 */
class HandleBlockPatternCategories {

	/**
	 * Holds the custom block pattern categories configuration.
	 *
	 * @var array
	 */
	private $custom_categories_config;

	/**
	 * Holds the core block pattern categories to unregister.
	 *
	 * @var array
	 */
	private $core_categories_to_unregister;

	/**
	 * Class constructor.
	 *
	 * Initializes the class by setting up the block pattern categories configuration.
	 *
	 * @param BlockPatternCategoriesConfig $config The configuration object for block pattern categories.
	 * @return void
	 */
	public function __construct( BlockPatternCategoriesConfig $config ) {
		$this->custom_categories_config      = $config->get_custom_block_pattern_category_configuration();
		$this->core_categories_to_unregister = $config->get_core_block_pattern_category_unregistration();
		$this->hook();
	}

	/**
	 * Registers WordPress hooks.
	 *
	 * Adds an action to modify all block pattern categories within the editor.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/init/
	 * @return void
	 */
	private function hook() {
		add_action( 'init', [ $this, 'manage_categories' ], 99 ); // Priority 99 ensures this runs after most other things
	}

	/**
	 * Manages block pattern categories by registering custom categories and un-registering core categories.
	 *
	 * Iterates through configuration to unregister selected core categories and registers new custom categories
	 * based on 'enable' status. Custom categories are labeled and sorted according to their configuration.
	 *
	 * @return void
	 */
	public function manage_categories() {
		$registry = \WP_Block_Pattern_Categories_Registry::get_instance();

		$this->unregister_core_categories( $registry );
		$custom_categories_configuration = $this->filter_and_prepare_custom_categories();

		$this->register_custom_categories( $registry, $custom_categories_configuration );
	}

	/**
	 * Un-registers core block pattern categories.
	 *
	 * @param \WP_Block_Pattern_Categories_Registry $registry The block pattern categories registry.
	 * @return void
	 */
	private function unregister_core_categories( $registry ) {
		foreach ( $this->core_categories_to_unregister as $category_slug ) {

			if ( $registry->is_registered( $category_slug ) ) {
				$unregistered = $registry->unregister( $category_slug );
				if ( ! $unregistered ) {
					Logger::logAndNotice( "Class " . __CLASS__ . ": Failed to unregister core block pattern category: {$category_slug}", 'error' );
				}
			} else {
				Logger::logAndNotice( "Class " . __CLASS__ . ": Core block pattern category '{$category_slug}' is not registered.", 'notice' );
			}
		}
	}

	/**
	 * Filters and prepares custom block pattern categories for registration.
	 *
	 * @return array An array of custom block pattern categories that are filtered and prepared.
	 */
	private function filter_and_prepare_custom_categories() {
		$custom_categories_configuration = array_filter( $this->custom_categories_config, function ($category) {
			return isset( $category['enable'] ) && $category['enable'];
		} );

		array_walk( $custom_categories_configuration, function (&$category) {
			if ( ! isset( $category['label'] ) || empty( $category['label'] ) ) {
				$category['label'] = ucfirst( str_replace( '_', ' ', $category['name'] ) );
			}
			$category['order'] = $category['order'] ?? PHP_INT_MAX;
		} );

		// Sort the custom categories
		uasort( $custom_categories_configuration, function ($a, $b) {
			return $a['order'] <=> $b['order'];
		} );

		return $custom_categories_configuration;
	}

	/**
	 * Registers custom block pattern categories.
	 *
	 * @param \WP_Block_Pattern_Categories_Registry $registry The block pattern categories registry.
	 * @param array $custom_categories_configuration The custom block pattern categories configuration.
	 * @return void
	 */
	private function register_custom_categories( $registry, $custom_categories_configuration ) {
		foreach ( $custom_categories_configuration as $category ) {
			$registered = $registry->register( $category['name'], [
				'label' => $category['label'],
			] );
			if ( ! $registered ) {
				Logger::logAndNotice( "Class " . __CLASS__ . ": Failed to register custom block pattern category: " . print_r( $category, true ), 'error' );
			}
		}
	}

}
