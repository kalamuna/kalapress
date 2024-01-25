<?php

namespace KLPTheme;

use KLPTheme\Core\Util\Logger;

/**
 * Displays breadcrumbs for the current page.
 *
 * Checks for the existence of the 'bcn_display' function provided by the Breadcrumbs NavXT plugin
 * and uses it to display the breadcrumbs. If the function is not available, logs an error message.
 * @TODO: // may worth implementing a custom breadcrumbs solution as a fallback.
 */
function display_breadcrumbs() {
	if ( function_exists( '\bcn_display' ) ) {
		echo '<div class="breadcrumbs">';

		\bcn_display();

		echo '</div>';
	} else {
		Logger::log( 'The function bcn_display() is not available. Please ensure the Breadcrumbs NavXT plugin is activated.' );
	}
}
