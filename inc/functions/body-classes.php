<?php

namespace KLPTheme;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array Modified body classes.
 * @package KLPTheme
 * @TODO: This has a great potential for specific styling. It can be used to
 * add classes to the body tag based on the page template, post type, etc.
 * A good subject for our practice meeting. Combined with patterns, it can
 * be used to create a very flexible system for specific styling.
 */
function body_classes( $classes ) {
	// Allows for incorrect snake case like is_IE to be used without throwing errors. Taken form wd_s
	global $is_IE, $is_edge, $is_safari;

	// If it's IE, add a class.
	if ( $is_IE ) {
		$classes[] = 'ie';
	}

	// If it's Edge, add a class.
	if ( $is_edge ) {
		$classes[] = 'edge';
	}

	// If it's Safari, add a class.
	if ( $is_safari ) {
		$classes[] = 'safari';
	}

	// Are we on mobile?
	if ( wp_is_mobile() ) {
		$classes[] = 'mobile';
	}

	// Give all pages a unique class.
	if ( is_page() ) {
		$classes[] = 'page--' . basename( get_permalink() );
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', space( 'body_classes' ) );
