<?php

namespace KLPTheme;

/**
 * Sets the content width based on the theme's design.
 *
 * @return void
 *
 * @package KLPTheme
 */
function set_content_width() {
	$GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', space( 'set_content_width' ), 0 );
