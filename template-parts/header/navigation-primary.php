<?php

use function KLPTheme\get_display_custom_menu;

?>

<nav class="nav-header--primary" aria-labelledby="nav-header--primary__heading">
	<h2 id="nav-header--primary__heading" class="screen-reader-text">Primary Menu</h2>
	<?php echo get_display_custom_menu( "menu-1" ); ?>
</nav>