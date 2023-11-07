<?php
/**
 * Handle Build Artifacts Class File
 *
 * Manages the cleaning process of block scripts that are artifacts of our build process.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\BlocksConfig;
use KLPTheme\Core\Util\Logger;

/**
 * HandleBuildArtifacts
 *
 * This class handles the cleaning process of block scripts that are artifacts
 * of our build process. Since we are using @wordpress/scripts to build our block scripts,
 * to compile the .scss files, we need to import them in a .js entry point so that webpack can
 * process them. However, these js files remain empty after the build and will be enqueued in the
 * front-end. This class is responsible for cleaning those empty scripts. It checks the scripts associated
 * with specific block types, and if those scripts are either empty or contain only comments, the class will deregister
 * and dequeue them from the WordPress enqueued scripts.
 * @TODO:  I need to investigae more because we are relying on the Cor's behaviour to look inside the blocks.json and enqueue the scripts
 * on demand. My mechanism works nice with ACF blocks, but not for native blocks. I need to investigate more.
 * These links will help to realize what other mechanisms are in place in the core. it seems that the core is relying on
 * the block rendering mechanisms to enqueue the scripts and that needs to be dug deeper.
 * @see https://github.com/WordPress/gutenberg/blob/da8555d258edbe676fa079fb51252f918ae032e1/lib/compat.php#L81
 * @see https://github.com/WordPress/gutenberg/pull/22754#issuecomment-789603778
 * @see https://github.com/WordPress/gutenberg/pull/25220#issuecomment-734677515
 * @see https://github.com/WordPress/gutenberg/pull/29537#discussion_r589972717
 * @sse https://github.com/WordPress/gutenberg/pull/29703
 * Note that the purpose of this class is not to change the way WP is enqueuing scripts, but to clean the empty scripts
 * that are the byproduct of our build process. If I see that this needs a very time consuming process, I will just
 * use the npm scripts and rimraf to clean certain scripts. Exactly the same way that we are doing for admin and editor assets.
 *
 */
class HandleBuildArtifacts {
	/**
	 * @var array List of target block names that should be checked.
	 */
	private $target_blocks = [];

	/**
	 * @var BlocksConfig The configuration instance for blocks.
	 */
	private $blocks_config;

	/**
	 * HandleBuildArtifacts constructor.
	 *
	 * Sets the blocks configuration and initializes the target blocks.
	 * Hooks into 'wp_enqueue_scripts' to deregister empty scripts.
	 *
	 * @param BlocksConfig $blocksConfig The configuration instance for blocks.
	 * @return void
	 */
	public function __construct( BlocksConfig $blocksConfig ) {
		$this->blocks_config = $blocksConfig;
		$this->target_blocks = $this->get_target_blocks();
		$this->hook();
	}

	/**
	 * Hooks into WordPress to enqueue and manipulate scripts.
	 * @return void
	 */
	private function hook() {
		add_action( 'wp_enqueue_scripts', [ $this, 'deregister_empty_scripts' ], 999 );
	}

	/**
	 * Retrieves the target blocks from the blocks configuration.
	 *
	 * @return array List of target block names that should be checked.
	 */
	private function get_target_blocks() {
		return array_keys( array_filter( $this->blocks_config->get_blocks_configuration(), function ($shouldBeRegistered) {
			return $shouldBeRegistered === true;
		} ) );
	}

	/**
	 * De-registers block scripts that are empty or only have comments.
	 *
	 * @uses \WP_Block_Type_Registry::get_instance()
	 * @uses \WP_Block_Type_Registry::get_all_registered()
	 * @uses global $wp_scripts
	 * @uses wp_script_is()
	 * @uses wp_dequeue_script()
	 * @uses wp_deregister_script()
	 * @return void
	 */
	public function deregister_empty_scripts() {
		global $wp_scripts;

		$registered_blocks = \WP_Block_Type_Registry::get_instance()->get_all_registered();

		foreach ( $registered_blocks as $block_name => $block_type ) {
			if ( $this->isTargetBlockWithScript( $block_name, $block_type ) ) {
				$handle = $block_type->script;
				$src    = $wp_scripts->registered[ $handle ]->src;

				if ( $this->isLocalScript( $src ) && wp_script_is( $handle, 'enqueued' ) ) {
					$path    = $this->convert_src_to_path( $src );
					$content = $this->getFileContent( $path );
					if ( $content !== false && $this->isEmptyOrCommentOnly( $content ) ) {
						wp_dequeue_script( $handle );
						wp_deregister_script( $handle );
					}
				}
			}
		}
	}

	/**
	 * Check if a block is a target block and has a script.
	 *
	 * @param string $block_name The block name.
	 * @param \WP_Block_Type $block_type The block type object.
	 * @return bool Whether the block is a target block with a script.
	 */
	private function isTargetBlockWithScript( $block_name, $block_type ) {

		return in_array( $block_name, $this->target_blocks, true ) && ! empty( $block_type->script );
	}

	/**
	 * Check if the script source is local.
	 *
	 * @param string $src The script source.
	 * @return bool Whether the source is local.
	 */
	private function isLocalScript( $src ) {

		return strpos( $src, site_url() ) !== false;
	}

	/**
	 * Convert a script source URL to a local file path.
	 *
	 * @param string $src The source URL
	 * @return string The local file path
	 */
	private function convert_src_to_path( $src ) {
		$relative_path = str_replace( site_url(), '', $src );

		return ABSPATH . ltrim( $relative_path, '/' );
	}

	/**
	 * Get the content of a the file at the given path.
	 * To be used in deregister_empty_scripts() method.
	 *
	 * @param string $path The file path.
	 * @throws \Exception Throws an exception if there's an issue in reading the file.
	 * @return false|string The file content or false on failure.
	 */
	private function getFileContent( $path ) {
		if ( ! file_exists( $path ) ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": File does not exist - {$path}", 'error' );
			return false;
		}

		$content = file_get_contents( $path );
		if ( $content === false ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Unable to read file - {$path}", 'error' );
			return false;
		}

		return $content;
	}

	/**
	 * Check if content is empty or contains only comments.
	 *
	 * @param string $content The content to check.
	 * @return bool Whether the content is empty or comment only.
	 */
	private function isEmptyOrCommentOnly( $content ) {
		$strip_comments = preg_replace( '!/\*.*?\*/!s', '', $content );
		$strip_comments = preg_replace( '/\n\s*\n/', "\n", $strip_comments );
		$strip_comments = preg_replace( '![ \t]*//.*[ \t]*[\r\n]!', '', $strip_comments );

		return strlen( trim( $strip_comments ) ) === 0;
	}
}
