<?php
/**
 *  HandleRegisterBlockStyles Class File
 *
 * Registers block styles.
 * Uses configuration settings to selectively enable block styles.
 *
 * @package    KLPTheme
 * @author     Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Config\BlockStylesConfig;

/**
 * Class HandleRegisterBlockStyles
 *
 * Registers block styles.
 *
 * @package KLPTheme
 */
class HandleRegisterBlockStyles {

	/**
	 * @var array
	 * The configuration array for block styles.
	 */
	private $config;

	/**
	 * HandleRegisterBlockStyles constructor.
	 *
	 * @param BlockStylesConfig $config
	 * @return void
	 */
	public function __construct( BlockStylesConfig $config ) {
		$this->config = $config->get_block_styles_configuration();
		$this->register_block_styles();
		$this->hook();
	}


	/**
	 * Hooks the register_block_styles method to the WordPress 'init' action.
	 * @uses add_action()
	 * @return void
	 */
	private function hook() {
		add_action( 'init', [ $this, 'register_block_styles' ] );
	}


	/**
	 * Registers block styles.
	 *
	 * @return void
	 */
	public function register_block_styles() {
		foreach ( $this->config as $block => $styles ) {
			$this->register_block_styles_from_config( $block, $styles );
		}
	}

	/**
	 * Registers block styles from configuration.
	 *
	 * @param string $block
	 * @param array $styles
	 * @uses register_block_style() from WP.
	 * @return void
	 */
	private function register_block_styles_from_config( $block, $styles ) {
		foreach ( $styles as $style_name => $style_config ) {
			$style_properties = [
				'name' => $style_name,
				'label' => $style_config['label'],
			];

			/* Just because core supports it, we will support it too.
			 * But it is discouraged in our practice.
			 */
			if ( isset( $style_config['inline_style'] ) ) {
				$style_properties['inline_style'] = $style_config['inline_style'];
			}

			/* optional handle to an already registered stylesheet. do not use yet for this reason:
			 * @see https://github.com/WordPress/gutenberg/issues/27244
			 */
			if ( isset( $style_config['style_handle'] ) ) {
				$style_properties['style_handle'] = $style_config['style_handle'];
			}

			if ( isset( $style_config['is_default'] ) ) {
				$style_properties['is_default'] = $style_config['is_default'];
			}

			register_block_style( $block, $style_properties );
		}
	}
}
