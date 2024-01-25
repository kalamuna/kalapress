<?php

namespace KLPTheme;

/**
 * Register  Custom Image Sizes
 *
 * @return void
 *
 * @package KLPTheme
 */
function add_custom_image_sizes() {
	add_image_size( 'hero-banner', 1920, 480, true );
	add_image_size( 'card-thumbnail', 1024, 682, true );
}
add_action( 'after_setup_theme', space( 'add_custom_image_sizes' ) );
