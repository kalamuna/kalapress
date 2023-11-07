<?php

namespace KLPTheme;

/**
 * Trait ThemeSettings
 *
 * Central spot for settings for this theme.
 *
 * @package KLPTheme
 */
trait Settings {

	private $asset_version_tag;
	private $theme_name = 'KWP Starter';
	private $theme_version = '1.0.0';
	private $transient_prefix = 'kwp_theme_';
	private $option_prefix = 'kwp_theme_';

	/**
	 * Default user roles for custom capabilities
	 *
	 * @var array
	 */
	protected $default_users_for_custom_roles = array(
		'editor',
		'administrator',
	);


	/**
	 * Stores the path to default images used in various places.
	 *
	 * @var string[]
	 */
	protected $default_images = array(
		'featured_image' => array(
			'blog' => '/wp-content/themes/kalapress/assets/images/generic-blog.jpg',
		),
	);


	/**
	 * Get the theme version.
	 *
	 * @return string
	 */
	public function get_version() {
		return $this->theme_version;
	}

	/**
	 * Get the theme name.
	 *
	 * @return string
	 */
	public function get_name() {
		// use wp_get_theme() stuff for this?
		return $this->theme_name;
	}


	/**
	 * Get the transient prefix
	 *
	 * @return string
	 */
	public function get_transient_prefix(): string {
		return $this->transient_prefix;
	}

	/**
	 * Get the option prefix
	 *
	 * @return string
	 */
	public function get_option_prefix(): string {
		return $this->option_prefix;
	}
}
