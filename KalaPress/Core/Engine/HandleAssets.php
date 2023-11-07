<?php
/**
 * Asset Manager Class File
 *
 * Handles the enqueuing of scripts and styles throughout the theme,
 * which includes the theme, admin, and editor assets.
 * This manager dynamically loads assets based on the provided
 * configuration and supports conditional enqueuing.
 *
 * @package KLPTheme
 * @author  Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\AssetsConfig;
use KLPTheme\Core\Util\Logger;

/**
 * Class HandleAssets
 *
 * Manages the enqueuing of the theme's scripts and styles based on a configuration array.
 * This class is responsible for loading both built and un-built assets,
 * handling conditional enqueuing through callbacks, and managing asset dependencies
 * and versioning through the presence of an index.asset.php file in the asset’s directory.
 *
 * @package KLPTheme
 */
class HandleAssets {

	/**
	 * Holds the assets configuration array.
	 *
	 * @var array
	 */
	private $config;

	/**
	 * Holds the theme directory path.
	 *
	 * @var string
	 */
	private $theme_path;

	/**
	 * Holds the theme URL.
	 *
	 * @var string
	 */
	private $theme_uri;

	/**
	 * Initializes the assets manager, setting up the paths and loading the assets configuration.
	 *
	 * @param AssetsConfig $assetsConfig The configuration object for assets.
	 * @return void
	 */
	public function __construct( AssetsConfig $assetsConfig ) {
		$this->theme_path = KLP_DIR;
		$this->theme_uri  = KLP_URI;
		$this->config     = $assetsConfig->get_assets_configuration();
		$this->hook();
	}

	/**
	 * Initializes the asset manager.
	 * Hooks into WordPress to enqueue assets at the appropriate times.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
	 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 * @see https://developer.wordpress.org/reference/hooks/enqueue_block_editor_assets/
	 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme/
	 *
	 * @return void
	 */
	private function hook() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_theme_assets' ] ); // For theme assets.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_assets' ] );
		add_action( 'after_setup_theme', [ $this, 'setup_editor_to_accept_frontend_styles' ] );
	}

	/**
	 * Enqueues theme assets.
	 * Handles the enqueuing of theme-specific assets.
	 *
	 * @return void
	 */
	public function enqueue_theme_assets() {
		$this->enqueue_assets( 'theme' );
	}

	/**
	 * Enqueues admin assets.
	 * Handles the enqueuing of WordPress admin-specific assets.
	 *
	 * @return void
	 */
	public function enqueue_admin_assets() {
		$this->enqueue_assets( 'admin' );
	}

	/**
	 * Enqueues editor assets.
	 * Handles the enqueuing of WordPress block editor-specific assets.
	 *
	 * @return void
	 */
	public function enqueue_editor_assets() {
		$this->enqueue_assets( 'editor' );
	}

	/**
	 * Enqueues assets based on the provided type.
	 * Enqueues assets conditionally based on the callback provided in the configuration array.
	 *
	 * @param string $type The type of asset to enqueue.
	 * @return void
	 */
	private function enqueue_assets( $type ) {
		if ( ! isset( $this->config[ $type ] ) )
			return;

		foreach ( $this->config[ $type ] as $asset ) {
			if ( $this->should_enqueue_asset( $asset ) ) {
				$this->enqueue_asset( $asset );
			}
		}
	}

	/**
	 * Determines whether an asset should be enqueued.
	 * Checks for the presence of an enqueue callback and its returned value.
	 *
	 * @param array $asset The asset configuration array.
	 * @return bool Whether the asset should be enqueued.
	 */
	private function should_enqueue_asset( $asset ) {

		return ! isset( $asset['enqueue_callback'] )
			|| ( is_callable( $asset['enqueue_callback'] ) && $asset['enqueue_callback']() );
	}

	/**
	 * Enqueues an individual asset based on its type.
	 * Decides whether the asset is a script or a style and enqueues accordingly.
	 *
	 * @param array $asset The associative array containing asset information.
	 * @return void
	 */
	private function enqueue_asset( $asset ) {
		$pathInfo = pathinfo( $asset['file'] ); // get pathinfo from 'file' key
		$dirname  = basename( $pathInfo['dirname'] ); // get the immediate folder name

		$handle = $asset['handle'] ?? $dirname; // if 'handle' is not set, use the immediate folder name as handle

		$this->load_asset_file( $asset, $handle );

		$main_asset_path = $this->theme_path . $asset['file'];
		if ( ! file_exists( $main_asset_path ) ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Main asset file $main_asset_path does not exist, make sure that the asset is compiled correctly.", 'error' );

			return;
		}

		if ( $asset['type'] === 'style' ) {
			$this->enqueue_style( $asset, $handle );
		} else { // if it's not a style, it must be a script
			$this->enqueue_script( $asset, $handle );
		}
	}

	/**
	 * Loads the asset file which contains dependency information and version.
	 * If the asset file is not found, logs an error.
	 *
	 * @param array $asset The associative array containing asset information.
	 * @param string $handle The handle for the asset.
	 * @return void
	 */
	private function load_asset_file( &$asset, $handle ) {
		// Derive the path from the file
		$dir_path = $this->theme_path . dirname( $asset['file'] );

		// Scan directory for any .asset.php file
		$asset_files     = preg_grep( '/\.asset\.php$/', scandir( $dir_path ) ?: [] );
		$asset_file_path = '';

		foreach ( $asset_files as $file ) {
			if ( file_exists( "$dir_path/$file" ) ) {
				$asset_file_path = "$dir_path/$file";
				break;
			}
		}

		if ( $asset_file_path ) {
			$asset_file       = include $asset_file_path;
			$asset['deps']    = $asset_file['dependencies'] ?? [];
			$asset['version'] = $asset_file['version'] ?? filemtime( $asset_file_path );
		} else {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Asset file not found in: $dir_path. Ensure that every asset has an .asset.php file.", 'error' );
		}
	}

	/**
	 * Enqueues a style asset.
	 * Considers media parameter for the style asset, with a default of 'all'.
	 *
	 * @param array $asset The associative array containing asset information.
	 * @param string $handle The handle for the asset.
	 * @uses wp_enqueue_style()
	 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @return void
	 */
	private function enqueue_style( $asset, $handle ) {
		$media = $asset['media'] ?? 'all';
		wp_enqueue_style( $handle, $this->theme_uri . $asset['file'], $asset['deps'] ?? [], $asset['version'] ?? null, $media );
	}

	/**
	 * Enqueues a script asset.
	 * Considers in_footer parameter for the script asset, defaulting to true.
	 *
	 * @param array $asset The associative array containing asset information.
	 * @param string $handle The handle for the asset.
	 * @uses wp_enqueue_script()
	 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @return void
	 */
	private function enqueue_script( $asset, $handle ) {
		$in_footer = $asset['in_footer'] ?? true;
		wp_enqueue_script( $handle, $this->theme_uri . $asset['file'], $asset['deps'] ?? [], $asset['version'] ?? null, $in_footer );
	}

	/**
	 * Sets up the editor to accept frontend styles.
	 * Also to respect the conditional enqueuing of styles. see below for caveats.
	 * This is necessary for the editor to display the same styles as the frontend.
	 * we are basically stealing the styles from the frontend and applying them to the editor.
	 *
	 * BUT THERE ARE SOME CAVEATS:
	 * - the editor will not be able to display styles that are applied conditionally
	 * so for example, if you have a style that is only applied to the homepage,
	 *
	 * the editor will also display that style even if you are not on the homepage edit screen.
	 * - To handle this issue, you can expand the 'enqueue_callback' key in the assets config
	 * and add a condition that checks if you are on the edit screen of the page that
	 * you want the style to be applied to.
	 *
	 * <code>
	 * 			'enqueue_callback' => function() {
	 * 				// If it's a frontend view and it's the homepage
	 * 				if (!is_admin() && is_front_page()) {
	 * 				return true;
	 * 			}
	 *
	 * 				// If we're in the editor and editing the 'page' post type (or more specifically, the homepage)
	 * 				if (is_admin() && get_current_screen()->base === 'post' && get_current_screen()->post_type === 'page') {
	 * 				return true;
	 * 			}
	 *
	 * 			return false;
	 * 			}
	 * </code>
	 * @uses add_editor_style()
	 * @see https://developer.wordpress.org/reference/functions/add_editor_style
	 *
	 * @return void
	 */
	public function setup_editor_to_accept_frontend_styles() {
		if ( isset( $this->config['theme'] ) ) {
			foreach ( $this->config['theme'] as $asset ) {
				if ( $asset['type'] === 'style' && $this->should_enqueue_asset( $asset ) ) {
					add_editor_style( $asset['file'] );
				}
			}
		}
	}
}
