<?php

/**
 * Taxonomies Configuration Class File
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Config;

/**
 * Taxonomies Configuration Class
 *
 * Handles the enablement and properties of custom taxonomies within the theme.
 * Custom taxonomies can be enabled or disabled for registration by toggling the
 * boolean value in the configuration array.
 *
 * @package KLPTheme
 */
class TaxonomiesConfig {

	/**
	 * Retrieves the configuration array for custom taxonomies.
	 * Acts as a central location for managing the availability of taxonomies within the theme.
	 *
	 * Each element in the returned array represents a custom taxonomy where the key is
	 * the slug of the taxonomy and the value is a boolean indicating whether the taxonomy
	 * is enabled for registration.
	 *
	 * @return array Associative array of taxonomy slugs to their enabled status.
	 * @example To enable the 'faq_types' taxonomy, set the 'faq_types' key to true.
	 */
	public function get_taxonomies_configuration() {
		return [
			'faq_types' => true,
			// Additional taxonomies can be added and configured in a similar manner.
		];
	}
}
