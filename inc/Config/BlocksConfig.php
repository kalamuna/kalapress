<?php

/**
 * Blocks Configuration Class File
 *
 * Manages and provides a centralized configuration for Gutenberg blocks in the theme.
 * This setup allows for quickly enabling or disabling specific blocks, which can be useful
 * during development or when adjusting the theme for different deployments.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Config;

/**
 * Blocks Configuration Class
 *
 * This class is responsible for the enablement and management of custom and native Gutenberg blocks
 * within the theme. Blocks are managed through a configuration array that determines which blocks
 * are available for use. By changing the configuration values, the theme can adapt to different
 * content strategies or user needs.
 *
 * @package KLPTheme
 */
class BlocksConfig {

	/**
	 * Retrieves the configuration array for Gutenberg blocks.
	 *
	 * The array keys correspond to the block names, which include both custom blocks prefixed with 'acf/'
	 * and native blocks. The boolean values indicate whether a block is enabled (`true`) or disabled (`false`).
	 *
	 * Acts as a central location for managing the availability of blocks within the theme.
	 *
	 * @return array Associative array of block names to their enabled status.
	 * @example To disable the 'acf/author' block, set the 'acf/author' key to false.
	 */
	public function get_blocks_configuration() {
		return [
			'acf/author'       => true,
			'acf/card'         => true,
			'acf/card--cover'  => true,
			'acf/download'     => true,
			'acf/faqs'         => true,
			'acf/social-links' => true,
			'acf/testimonial'  => true,
			'acf/accordion'    => true,
			// Sample blocks for demonstration or testing
			'acf/sample-faqs'  => true,
			'native/dynamic'   => true,
			'native/static'    => true,
			// Additional blocks can be added here following the same pattern.
		];
	}
}
