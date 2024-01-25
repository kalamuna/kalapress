<?php

namespace KLPTheme;

/**
 * Remove unnecessary header tags
 * Turn these on or off based on the project requirements.
 * Default is off.
 *
 * @return void
 */
function cleanup_wordpress() {
	remove_action( 'wp_head', 'wp_generator' ); // remove wordpress version
	remove_action( 'wp_head', 'feed_links', 2 ); // remove rss feed links
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // removes all extra rss feed links
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // remove next and previous post links
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Remove shortlink
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // Remove REST API link tag from header (dosn't deactivate the REST API)
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 ); // Remove oEmbed discovery links
	remove_action( 'wp_head', 'rsd_link' ); // remove really simple discovery link
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
}

add_action( 'init', space( 'cleanup_wordpress' ) );
