<?php
/**
 * HandleRegisterBlocks Class File
 *
 * Defines the HandleRegisterBlocks class responsible for the registration of
 * custom Gutenberg blocks in the theme.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\BlocksConfig;
use KLPTheme\Core\Util\Logger;

/**
 * Handles registering blocks.
 *
 * This class scans specified directories to register custom Gutenberg blocks based on
 * the provided configuration settings. It hooks into WordPress at the 'init' action
 * and utilizes the BlocksConfig to determine which blocks are enabled.
 *
 * @package KLPTheme
 */
class HandleRegisterBlocks {

	/**
	 * Contains the configuration for blocks to decide if they should be registered or not.
	 *
	 * @var array<bool>
	 */
	private $blocks_config;

	/**
	 * Specifies the directories containing the blocks to be registered.
	 *
	 * @var array<string>
	 */
	private $directories = [
		'acf'    => '/build/blocks/acf',
		'native' => '/build/blocks/native'
	];

	/**
	 * Stores the path to the theme directory.
	 *
	 * @var string
	 */
	private $theme_path;

	/**
	 * Constructs the HandleRegisterBlocks object.
	 * Sets the theme path and the blocks configuration.
	 *
	 * @param BlocksConfig $blocksConfig The blocks configuration.
	 * @return void
	 */
	public function __construct( BlocksConfig $blocksConfig ) {
		$this->theme_path    = KLP_DIR;
		$this->blocks_config = $blocksConfig->get_blocks_configuration();
		$this->hook();
	}


	/**
	 * Hooks into WordPress to register blocks.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/init/
	 * @return void
	 */
	private function hook() {
		add_action( 'init', [ $this, 'register_blocks' ] );
	}

	/**
	 * Registers blocks from the specified directories.
	 *
	 * @return void
	 */
	public function register_blocks() {
		foreach ( $this->directories as $subdir ) {
			$directory_path = $this->theme_path . $subdir;
			if ( $this->is_valid_directory( $directory_path ) ) {
				$this->register_blocks_from_directory( $directory_path );
			}
		}
	}

	/**
	 * Determines if a directory exists.
	 *
	 * @param string $directory_path The path to the directory.
	 * @throws \Exception If there is an error reading the directory.
	 * @return bool True if the directory exists, otherwise false.
	 */
	private function is_valid_directory( $directory_path ) {
		if ( ! is_dir( $directory_path ) ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Directory does not exist: {$directory_path} --- ❓: did you run the build command?", 'error' );
			return false;
		}
		return true;
	}

	/**
	 * Registers blocks from a specified directory.
	 *
	 * @param string $directory_path The path to the directory.
	 * @throws \Exception If there is an error reading the directory.
	 * @return void
	 */
	private function register_blocks_from_directory( $directory_path ) {
		try {
			$blocks_in_directory = $this->get_blocks_in_directory( $directory_path );
			foreach ( $blocks_in_directory as $block ) {
				$this->register_block( $directory_path, $block );
			}
		} catch (\Exception $e) {
			Logger::handleException( $e );
		}
	}

	/**
	 * Gets the blocks in a specified directory.
	 *
	 * @param string $directory_path The path to the directory.
	 * @throws \Exception If there is an error reading the directory.
	 * @return array<string> The blocks in the directory.
	 */
	private function get_blocks_in_directory( $directory_path ) {
		$blocks_in_directory = scandir( $directory_path );
		if ( $blocks_in_directory === false ) {
			throw new \Exception( 'Unable to read the directory: ' . $directory_path );
		}

		// Remove the '.' and '..' from the directories array that are returned by scandir(). since they don't contain blocks.
		return array_filter( $blocks_in_directory, function ($item) {
			return $item !== '.' && $item !== '..';
		} );
	}

	/**
	 * Registers a block using the block.json file.
	 *
	 * @param string $directory_path The path to the directory.
	 * @param string $block The name of the block.
	 * @throws \Exception If there is an error reading the block.json file.
	 * @uses register_block_type() from WP Registers the block type using the block.json configuration.
	 * @see https://developer.wordpress.org/reference/functions/register_block_type
	 * @return void
	 */
	private function register_block( $directory_path, $block ) {
		$block_json_path = $directory_path . '/' . $block . '/block.json';
		if ( ! file_exists( $block_json_path ) ) {
			Logger::logAndNotice( "Class " . __CLASS__ . ": Missing block.json for block: {$block}", 'error' );
			return;
		}

		$block_data = json_decode( file_get_contents( $block_json_path ), true );
		if ( $this->should_register_block( $block_data['name'] ) ) {

			register_block_type( $block_json_path );
		}
	}

	/**
	 * Determines if a block should be registered based on the blocks configuration.
	 *
	 * @param string $block_name The name of the block.
	 * @return bool True if the block should be registered, otherwise false.
	 */
	private function should_register_block( $block_name ) {
		return isset( $this->blocks_config[ $block_name ] ) && $this->blocks_config[ $block_name ];
	}
}
