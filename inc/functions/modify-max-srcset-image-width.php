<?php

namespace KLPTheme;

/**
 * Modifies the maximum width of the srcset attribute for the generated image sizes.
 *
 * @param string $max_width Maximum image width to be included in 'srcset' attribute.
 * @param array  $size_array Array of width and height values in pixels (in that order).
 *
 * @return int Filtered maximum image width.
 */
function modify_max_srcset_image_width( $max_width, $size_array ) {
	return 1440;
}
add_filter( 'max_srcset_image_width', space( 'modify_max_srcset_image_width' ), 10, 2 );
