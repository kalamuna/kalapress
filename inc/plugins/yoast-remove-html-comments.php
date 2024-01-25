<?php

namespace KLPTheme;

/**
 * Removes the HTML comments by the Yoast SEO plugin on the front-end.
 * Comments like: <!-- This site is optimized with the Yoast SEO plugin...-->
 *
 * @return void
 * @package KLPTheme
 */
function yoast_remove_html_comments() {
	add_filter( 'wpseo_debug_markers', '__return_false' );
}

add_action( 'init', space( 'yoast_remove_html_comments' ) );
