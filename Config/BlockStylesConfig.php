<?php
/**
 * Block Styles Configuration File
 *
 * Configures block styles.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Config;

/**
 * Class BlockStylesConfig
 *
 * Configures block styles.
 *
 * @package KLPTheme
 */
class BlockStylesConfig {

	/**
	 * Retrieves the configuration array for block styles.
	 *
	 * Each element in the array represents a block style where the key is
	 * the block name, and the value is an array of styles. Each style array can include:
	 * - name: the identifier of the style used to compute a CSS class.
	 * - label: a human-readable label for the style.
	 * - inline_style: optional inline CSS code for the style.
	 * - style_handle: optional handle to an already registered stylesheet. do not use yet for this reason:
	 * @see https://github.com/WordPress/gutenberg/issues/27244
	 *
	 * - is_default: optional boolean to set the style as the default.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_style
	 * @see https://developer.wordpress.org/news/2023/02/creating-custom-block-styles-in-wordpress-themes
	 *
	 * Tip: to find the correct block name, open the block editor, launch the browser console
	 * and type wp.blocks.getBlockTypes(). You will see the complete list of block names
	 * (from core or third-party).
	 *
	 * @return array Configuration array for block styles.
	 *
	 * @TODO: //Watch for the resolve of the issue with style_handle. Then adopt.
	 * Needs changes in how we have arranged the saas files in the theme.
	 * We will need to create separate files for each block style and handle them like blocks.
	 * The advantage is that the style only loads when the block is used and the style is selected.
	 *
	 * @TODO: //Note the way that will be able to change block styles in the future will change most likely.
	 * since the theme.json file will be used to configure block styles.
	 * also for the custom blocks, we can use the block.json file to configure block styles now.
	 */
	public function get_block_styles_configuration() {
		return [
			'core/list' => [
				'checkmark' => [
					'label' => __( 'Checkmark', KLP_TXT_DOMAIN ),
					// 'is_default' => true,
					// 'inline_style' => '.is-style-checkmark { list-style-type: checkmark; }',
					// 'style_handle' still has a bug in WordPress as of 6.4, so do not use for now.
				],
				'no-disc' => [
					'label' => __( 'No disc', KLP_TXT_DOMAIN ),
				],
			],
			'core/button' => [
				'alternate' => [
					'label' => __( 'Alternate', KLP_TXT_DOMAIN ),
				],
			],
		];
	}
}
