<?php

use function KLPTheme\get_display_custom_menu;

?>

<details class="menu-toggle">
	<summary>
		<div class="menu-toggle__content">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
		<p class="menu-toggle__label screen-reader-text">Menu</p>
	</summary>

	<div class="nav-header--flyout__content">
		<nav class="nav-header--flyout" aria-labelledby="nav-header--flyout__heading">
			<h2 id="nav-header--flyout__heading" class="screen-reader-text">Flyout Menu</h2>
			<?php echo get_display_custom_menu( "menu-1" ); ?>
		</nav>

		<div class="searchform--flyout">
			<form action="/" role="search" method="get" id="search-form-flyout" class="searchform__form">
				<label for="search-flyout" class="screen-reader-text">Search</label>
				<input type="search" value="" name="s" id="search-flyout" placeholder="Search" />
				<button type="submit" id="search-flyout-submit" value="Search">
					<svg style="max-width: 1em;" width="20" height="20" viewBox="0 0 20 20" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M7.42857 0C9.39875 0 11.2882 0.78265 12.6814 2.17578C14.0745 3.56891 14.8571 5.45839 14.8571 7.42857C14.8571 9.26857 14.1829 10.96 13.0743 12.2629L13.3829 12.5714H14.2857L20 18.2857L18.2857 20L12.5714 14.2857V13.3829L12.2629 13.0743C10.96 14.1829 9.26857 14.8571 7.42857 14.8571C5.45839 14.8571 3.56891 14.0745 2.17578 12.6814C0.78265 11.2882 0 9.39875 0 7.42857C0 5.45839 0.78265 3.56891 2.17578 2.17578C3.56891 0.78265 5.45839 0 7.42857 0ZM7.42857 2.28571C4.57143 2.28571 2.28571 4.57143 2.28571 7.42857C2.28571 10.2857 4.57143 12.5714 7.42857 12.5714C10.2857 12.5714 12.5714 10.2857 12.5714 7.42857C12.5714 4.57143 10.2857 2.28571 7.42857 2.28571Z"
							fill="#191919" />
					</svg>
				</button>
			</form>
		</div>
	</div>
</details>