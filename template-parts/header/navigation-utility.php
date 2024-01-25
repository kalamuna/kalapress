<?php

use function KLPTheme\get_display_custom_menu;

?>

<nav role="navigation" class="nav-header--utility">
	<?php echo get_display_custom_menu( "menu-4" ); ?>

	<div class="searchform searchform--reveal">
		<button class="searchform--reveal__toggle">
			<svg style="max-width: 1em;" width="20" height="20" viewBox="0 0 20 20" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<path
					d="M7.429 0a7.43 7.43 0 0 1 7.429 7.429c0 1.84-.674 3.531-1.783 4.834l.309.309h.903L20 18.286 18.286 20l-5.714-5.714v-.903l-.309-.309c-1.303 1.109-2.994 1.783-4.834 1.783A7.43 7.43 0 0 1 0 7.429 7.43 7.43 0 0 1 7.429 0zm0 2.286a5.12 5.12 0 0 0-5.143 5.143 5.12 5.12 0 0 0 5.143 5.143 5.12 5.12 0 0 0 5.143-5.143 5.12 5.12 0 0 0-5.143-5.143z"
					fill="#191919" />
			</svg>
			<span class="screen-reader-text">Search toggle</span>
		</button>
		<form action="/" role="search" method="get" id="searchformTop" class="searchform__form open">
			<label for="search-top" class="screen-reader-text">Search</label>
			<input type="search" value="" name="s" id="search-top" placeholder="Search" />
			<input type="submit" id="searchsubmit" value="Search" />
		</form>
	</div>
</nav>