<?php
/**
 * Handle Included Functions Class File
 *
 * Responsible for the dynamic inclusion of PHP files within
 * the inc folder (except for post-types and taxonomies ).
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\IncludedFunctionsConfig;
use KLPTheme\Core\Util\Logger;

/**
 * HandleIncludedFunctions
 *
 * This class handles the dynamic inclusion of PHP files within the theme.
 * It checks the included functions configuration and includes the PHP files that are enabled.
 *
 * @package KLPTheme
 */
class HandleIncludedFunctions {

	/**
	 * Stores the configuration for included files.
	 *
	 * @var array
	 */
	private $config;

	/**
	 * Stores the path to the inc directory.
	 *
	 * @var string
	 */
	private $inc_path;

	/**
	 * Class constructor.
	 *
	 * Initializes the class by setting up the included files configuration
	 * and includes the files immediately.
	 *
	 * @param IncludedFunctionsConfig $config The configuration object for included files.
	 * @return void
	 */
	public function __construct( IncludedFunctionsConfig $config ) {
		$this->config = $config->get_included_files_configuration();
		$this->inc_path = KLP_INC_DIR;
		$this->include_files();
	}

	/**
	 * Includes the PHP files that are enabled in the configuration.
	 *
	 * @return void
	 */
	public function include_files() {
		foreach ( $this->config as $dir => $files ) {
			$path = $this->inc_path . '/' . $dir;
			if ( ! $this->check_directory( $path ) ) {
				continue;
			}

			foreach ( $files as $file ) {
				$file_path = "{$path}/{$file}.php";

				if ( $this->check_file( $file_path ) ) {
					include_once $file_path;
				}
			}
		}
	}

	/**
	 * Checks if a directory exists.
	 *
	 * @param string $path The path to the directory.
	 * @throws \Exception Throws an exception if the directory does not exist.
	 * @return bool True if the directory exists, false otherwise.
	 */
	private function check_directory( $path ) {
		if ( ! is_dir( $path ) ) {
			Logger::logAndNotice( "<span class='black-tag bold mb'>Class " . __CLASS__ . ":</span></br> Include directory does not exist: {$path}", 'error' );
			return false;
		}
		return true;
	}

	/**
	 * Checks if a file exists.
	 *
	 * @param string $file_path The path to the file.
	 * @throws \Exception Throws an exception if the file does not exist.
	 * @return bool True if the file exists, false otherwise.
	 */
	private function check_file( $file_path ) {
		if ( ! file_exists( $file_path ) ) {
			Logger::logAndNotice( "<span class='black-tag bold mb'>Class " . __CLASS__ . ":</span></br> The file {$file_path} does not exist", 'error' );
			return false;
		}
		// Removed the function existence check; now we only check if the file exists.
		return true;
	}
}
