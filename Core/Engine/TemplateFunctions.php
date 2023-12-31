<?php
/**
 * Template functions class file.
 * @TODO: Haven't been optimized yet and is next in line for refactoring.
 * Most of it must be nuked. some may be distributed to other classes.
 *
 * @package Kalapress
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

class TemplateFunctions {
	public function __construct() {
		add_filter( 'body_class', array( $this, 'kalapress_body_classes' ) );
		add_action( 'wp_head', array( $this, 'kalapress_pingback_header' ) );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function kalapress_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function kalapress_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

}
