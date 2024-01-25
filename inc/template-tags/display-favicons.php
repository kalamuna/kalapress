<?php

namespace KLPTheme;

/**
 * Displays favicon links for the theme.
 *
 */
function display_favicons() {
	// favicon package generated from: https://realfavicongenerator.net/
	?>
	<link rel="apple-touch-icon" sizes="180x180"
		href="<?php echo esc_url( KLP_URI . '/src/images/favicons/apple-touch-icon.png' ); ?>">
	<link rel="icon" type="image/png" sizes="32x32"
		href="<?php echo esc_url( KLP_URI . '/src/images/favicons/favicon-32x32.png' ); ?>">
	<link rel="icon" type="image/png" sizes="16x16"
		href="<?php echo esc_url( KLP_URI . '/src/images/favicons/favicon-16x16.png' ); ?>">
	<link rel="manifest" href="<?php echo esc_url( KLP_URI . '/src/images/favicons/site.webmanifest' ); ?>">
	<link rel="mask-icon"
		href="<?php echo esc_url( KLP_URI . '/src/images/favicons/safari-pinned-tab.svg' ); ?>"
		color="#5bbad5">
	<?php
}
