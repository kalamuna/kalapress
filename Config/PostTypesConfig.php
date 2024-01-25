<?php

/**
 * Post Types Configuration Class File
 *
 * Provides a centralized place to manage the configuration of custom post types.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Config;

/**
 * Post Types Configuration Class
 *
 * Manages the enablement and properties of custom post types within the theme.
 * Post types can be dynamically enabled or disabled for registration by toggling
 * the boolean value associated with their key in the configuration array.
 * For each post type, there should be a file in the inc/posttypes/ directory.
 *
 * @package KLPTheme
 */
class PostTypesConfig {

	/**
	 * Retrieves the configuration array for custom post types.
	 * Acts as a central location for managing the availability of post types within the theme.
	 *
	 * Each element in the returned array represents a custom post type where the key is
	 * the slug of the post type and the value is a boolean indicating whether the post type
	 * is enabled for registration.
	 *
	 * @return array Associative array of post type slugs to their enabled status.
	 * @example To enable the 'faqs' post type, ensure the 'faqs' key is set to true.
	 */
	public function get_post_types_configuration() {
		return [
			'faqs'        => true,
			'team_member' => true,
		];
	}
}
