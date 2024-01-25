<?php

/**
 * Handle Theme Setup Class
 *
 * Sets up various WordPress theme features and configurations.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

/**
 * Handle Theme Setup Class
 *
 * Sets up various WordPress theme features and configurations.
 *
 * @package KLPTheme
 */
class HandleThemeSetup {

	/**
	 * HandleThemeSetup constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->hook();
	}

	/**
	 * Hooks necessary methods to WordPress actions and filters.
	 *
	 * @return void
	 */
	private function hook() {
		add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
		add_action( 'after_setup_theme', [ $this, 'setup_localization' ] );
		add_action( 'after_setup_theme', [ $this, 'register_nav_menus' ] );
		add_action( 'after_setup_theme', [ $this, 'setup_block_editor_related_additions' ] );
		$this->remove_support_for_core_block_patterns();
		$this->load_separate_inline_core_block_styles();
	}

	/**
	 * Sets up Gutenberg editor features like wide alignment and editor styles.
	 * Note: add_editor_style() must be used to add the theme stylesheet to the editor,
	 * when we are adding support for editor-styles.
	 * We are using it in:
	 * @see KLPTheme\Core\Engine\HandleAssets class for the sake of consistency.
	 */
	public function setup_block_editor_related_additions() {
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'block-templates' );
		// support html templates and activate the site editor like in FSE themes.
		add_theme_support( 'block-template-parts' );
	}

	/**
	 * opt-in to inline-print core block styles only if they are present on the front-end.
	 * This filter was added in WordPress 5.8.
	 * @see https://make.wordpress.org/core/2021/07/01/block-styles-loading-enhancements-in-wordpress-5-8/
	 *
	 * @return void
	 */
	public function load_separate_inline_core_block_styles() {
		add_filter( 'should_load_separate_core_block_assets', '__return_true' );
	}

	/**
	 * Removes support for core block patterns.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/should_load_remote_block_patterns/
	 *
	 * @return void
	 */
	public function remove_support_for_core_block_patterns() {
		add_filter( 'should_load_remote_block_patterns', '__return_false' );
	}

	/**
	 * Sets up localization for the theme.
	 */
	public function setup_localization() {
		load_theme_textdomain( KLP_TXT_DOMAIN, KLP_DIR . '/languages' );
	}

	/**
	 * Registers navigation menus for the theme.
	 * @see https://developer.wordpress.org/reference/functions/register_nav_menus/
	 *
	 * @return void
	 */
	public function register_nav_menus() {
		register_nav_menus( [
			'menu-1' => esc_html__( 'Primary', KLP_TXT_DOMAIN ),
			'menu-2' => esc_html__( 'Secondary', KLP_TXT_DOMAIN ),
			'menu-3' => esc_html__( 'Footer Utility', KLP_TXT_DOMAIN ),
			'menu-4' => esc_html__( 'Header Utility', KLP_TXT_DOMAIN ),
			'menu-5' => esc_html__( 'Eyebrow', KLP_TXT_DOMAIN ),
		] );
	}

	/**
	 * Configures various WordPress features for the theme.
	 * @see https://developer.wordpress.org/reference/functions/add_theme_support/
	 *
	 * @return void
	 */
	public function theme_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', [
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
		] );
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
}
