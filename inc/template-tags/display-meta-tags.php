<?php

namespace KLPTheme;

/**
 * Displays theme-specific meta tags, including charset, viewport, and profile link.
 */
function display_meta_tags() {
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta name="msapplication-TileColor" content="#ce3c90">
	<meta name="theme-color" content="#ffffff">
	<?php
}
