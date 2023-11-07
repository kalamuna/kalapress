<?php

/**
 * HandleTaxonomies Class File
 *
 * Handles the registration of custom taxonomies for the theme.
 * Utilizes configuration settings to selectively enable taxonomies.
 *
 * @package    KLPTheme
 * @author     Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\TaxonomiesConfig;
use KLPTheme\Core\Util\Logger;

/**
 * Class HandleTaxonomies
 *
 * Handles the registration of custom taxonomies.
 */
class HandleTaxonomies {

	/**
	 * Configuration for taxonomies.
	 *
	 * @var array<bool>
	 */
	private $taxonomies_config;

	/**
	 * Path to the theme directory.
	 *
	 * @var string
	 */
	private $theme_path;

	/**
	 * HandleTaxonomies constructor.
	 * Sets the path to the theme and taxonomies configuration.
	 *
	 * @param TaxonomiesConfig $taxonomiesConfig Configuration for taxonomies.
	 */
	public function __construct( TaxonomiesConfig $taxonomiesConfig ) {
		$this->theme_path        = KLP_DIR;
		$this->taxonomies_config = $taxonomiesConfig->get_taxonomies_configuration();
		$this->hook();
	}

	/**
	 * Hooks the register_taxonomies method to the WordPress 'init' action.
	 * @uses add_action()
	 */
	private function hook() {
		add_action( 'init', [ $this, 'register_taxonomies' ] );
	}

	/**
	 * Iterates through the taxonomies configuration and registers each enabled taxonomy.
	 *
	 * @throws \Exception Throws an exception if there's an issue in registering taxonomies.
	 * @return void
	 */
	public function register_taxonomies() {
		$directory_path = $this->theme_path . '/inc/taxonomies/';

		if ( ! is_dir( $directory_path ) ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Directory does not exist: " . $directory_path, 'error' );
			return;
		}

		try {
			foreach ( $this->taxonomies_config as $taxonomy => $isEnabled ) {
				if ( $isEnabled ) {
					$this->register_taxonomy( $directory_path, $taxonomy );
				}
			}
		} catch (\Exception $e) {
			Logger::handleException( $e, true );
		}
	}

	/**
	 * Registers a single taxonomy.
	 *
	 * Includes the taxonomy's PHP file and calls its registration function. The registration function
	 * is expected to follow a naming convention: 'register_{taxonomy}_taxonomy'. This naming convention
	 * allows for a predictable and standardized way of invoking taxonomy registration functions.
	 *
	 * @param string $directory_path Path to the directory containing the taxonomy files.
	 * @param string $taxonomy Name of the taxonomy to register.
	 * @throws \Exception Throws an exception if there's an issue in registering the taxonomy.
	 * @return void
	 * @example If the taxonomy name is 'genre', the registration function should be named 'register_genre_taxonomy'.
	 */
	private function register_taxonomy( $directory_path, $taxonomy ) {
		$taxonomy_file_path = $directory_path . $taxonomy . '.php';

		if ( ! file_exists( $taxonomy_file_path ) ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Missing file for taxonomy: " . $taxonomy, 'error' );
			return;
		}

		require_once $taxonomy_file_path;

		$register_function = "KLPTheme\\register_{$taxonomy}_taxonomy";

		if ( function_exists( $register_function ) ) {
			call_user_func( $register_function );
		} else {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Registration function does not exist: " . $register_function, 'error' );
		}
	}
}
