<?php
/**
 * Handle Post Types Class File
 *
 * Responsible for the dynamic registration of custom post types within the theme.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\PostTypesConfig;
use KLPTheme\Core\Util\Logger;

/**
 * HandlePostTypes
 *
 * This class handles the dynamic registration of custom post types within the theme.
 * It checks the post types configuration and registers the post types that are enabled.
 *
 * @package KLPTheme
 */
class HandlePostTypes {

	/**
	 * Stores the configuration for post types.
	 *
	 * @var array
	 */
	private $post_types_config;

	/**
	 * Stores the path to the theme directory.
	 *
	 * @var string
	 */
	private $theme_path;

	/**
	 * Class constructor.
	 *
	 * Initializes the class by setting up the post types configuration.
	 *	 * Sets up the theme path and post types configuration.
	 * @param PostTypesConfig $postTypesConfig The configuration object for post types.
	 * @return void
	 */
	public function __construct( PostTypesConfig $postTypesConfig ) {
		$this->theme_path        = KLP_DIR;
		$this->post_types_config = $postTypesConfig->get_post_types_configuration();
		$this->hook();
	}

	/**
	 * Registers WordPress hooks.
	 * Adds an action to register all post types within the theme.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/init/
	 * @return void
	 */
	private function hook() {
		add_action( 'init', [ $this, 'register_post_types' ] );
	}

	/**
	 * Registers all post types within the theme.
	 * Iterates through the post types configuration and registers each enabled post type.
	 * @throws \Exception Throws an exception if there's an issue in registering post types.
	 * @return void
	 */
	public function register_post_types() {
		$directory_path = $this->theme_path . '/inc/post_types/';

		if ( ! is_dir( $directory_path ) ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Directory does not exist: " . $directory_path, 'error' );
			return;
		}

		foreach ( $this->post_types_config as $post_type => $isEnabled ) {
			if ( $isEnabled ) {
				try {
					$this->include_post_type_file( $directory_path, $post_type );
				} catch (\Exception $e) {
					Logger::handleException( $e, true );
				}
			}
		}
	}

	/**
	 * Includes the file for a given post type if it exists and calls its registration function.
	 *
	 * @param string $directory_path Path to the directory containing post type files.
	 * @param string $post_type The post type to include the file for.
	 * @throws \Exception Throws an exception if there's an issue in including the post type file.
	 * @return void
	 */
	private function include_post_type_file( $directory_path, $post_type ) {
		$post_type_file_path = $directory_path . $post_type . '.php';

		if ( ! file_exists( $post_type_file_path ) ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Missing file for post type: " . $post_type, 'error' );
			return;
		}

		require_once $post_type_file_path;
		$this->register_post_type( $post_type );
	}

	/**
	 * Calls the registration function for the given post type.
	 *
	 * Includes the post type's PHP file and calls its registration function. The registration function
	 * is expected to follow a naming convention: 'register_{post_type}_post_type'. This naming convention
	 * allows for a predictable and standardized way of invoking post type registration functions.
	 *
	 * @param string $post_type The post type to register.
	 * @throws \Exception Throws an exception if there's an issue in registering the post type.
	 * @return void
	 * @example If the post type is 'event', the registration function should be named 'register_event_post_type'.
	 */
	private function register_post_type( $post_type ) {
		$register_function = "KLPTheme\\register_{$post_type}_post_type";

		if ( function_exists( $register_function ) ) {
			call_user_func( $register_function );
		} else {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Registration function does not exist: " . $register_function, 'error' );
		}
	}
}
