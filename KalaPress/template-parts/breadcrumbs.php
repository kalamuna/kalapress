<?php

namespace KLPTheme;

?>

<div class="breadcrumbs">
	<?php
	//If we're using the Breadcrumbs NavXT plugin
	if ( function_exists( '\bcn_display' ) ) {
		\bcn_display();
	} else {
		//@TODO: // investigate why the Logger::logAndNotice() function is not working here.
		error_log( 'The function bcn_display() is not available. Please ensure the Breadcrumbs NavXT plugin is activated.' );
	}
	?>
</div>
