<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kalapress
 */

namespace KLPTheme;

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<?php
	if ( have_rows( 'global_scripts', 'option' ) ) :
		while ( have_rows( 'global_scripts', 'option' ) ) :
			the_row();
			$script          = get_sub_field( 'script' );
			$script_location = get_sub_field( 'script_location' );
			if ( $script_location == 'header_start' && get_sub_field( 'enable_script' ) ) :
				echo "\n<!-- Theme Option Header Scripts: " . get_sub_field( 'script_name' ) . " -->\n";
				echo $script . "\n";
			endif;
		endwhile;
	endif;
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- favicon package generated from: https://realfavicongenerator.net/ -->
	<link rel="apple-touch-icon" sizes="180x180"
		href="<?php echo get_template_directory_uri(); ?>/src/images/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32"
		href="<?php echo get_template_directory_uri(); ?>/src/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16"
		href="<?php echo get_template_directory_uri(); ?>/src/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/src/images/favicons/site.webmanifest">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/src/images/favicons/safari-pinned-tab.svg"
		color="#5bbad5">
	<meta name="msapplication-TileColor" content="#ce3c90">
	<meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>
	<?php
	if ( have_rows( 'global_scripts', 'option' ) ) :
		while ( have_rows( 'global_scripts', 'option' ) ) :
			the_row();
			$script          = get_sub_field( 'script' );
			$script_location = get_sub_field( 'script_location' );
			if ( $script_location == 'header_end' && get_sub_field( 'enable_script' ) ) :
				echo $script . "\n";
			endif;
		endwhile;
	endif;
	?>
</head>

<body <?php body_class( 'mouse-input' ); ?>>
	<?php
	if ( have_rows( 'global_scripts', 'option' ) ) :
		while ( have_rows( 'global_scripts', 'option' ) ) :
			the_row();
			$script          = get_sub_field( 'script' );
			$script_location = get_sub_field( 'script_location' );
			if ( $script_location == 'body_start' && get_sub_field( 'enable_script' ) ) :
				echo "\n<!-- Theme Option Header Scripts: " . get_sub_field( 'script_name' ) . " -->\n";
				echo $script . "\n";
			endif;
		endwhile;
	endif;
	?>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header id="site-header" class="site-header">
			<a class="skip-link screen-reader-text" href="#main-content">
				<?php esc_html_e( 'Skip to content', 'kalapress' ); ?>
			</a>
			<div class="site-header__container">

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-link">
					<div class="site-header__logo">
						<?php
						if ( get_field( 'header_logo_desktop', 'option' ) ) :
							$logo = get_field( 'header_logo_desktop', 'option' );
							echo '<img src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" class="site-header__logo-image">';
						endif;
						if ( get_field( 'header_logo_snapped', 'option' ) ) :
							$logo_snapped = get_field( 'header_logo_snapped', 'option' );
							echo '<img src="' . $logo_snapped['url'] . '" alt="' . $logo_snapped['alt'] . '" class="site-header__logo-image--small">';
						else :
							if ( get_field( 'header_logo_desktop', 'option' ) ) :
								$logo = get_field( 'header_logo_desktop', 'option' );
								echo '<img src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" class="site-header__logo-image--small">';
							endif;
						endif;
						?>
						<span class="screen-reader-text">
							<?php bloginfo( 'name' ); ?>
						</span>
					</div>
				</a>

				<div class="site-header__content">
					<!-- Utility Navigation -->
					<nav role="navigation" class="nav-header--utility">
						<?php create_custom_menu( "menu-4" ); ?>

						<div class="searchform searchform--reveal">
							<button class="searchform--reveal__toggle">
								<svg style="max-width: 1em;" width="20" height="20" viewBox="0 0 20 20" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M7.42857 0C9.39875 0 11.2882 0.78265 12.6814 2.17578C14.0745 3.56891 14.8571 5.45839 14.8571 7.42857C14.8571 9.26857 14.1829 10.96 13.0743 12.2629L13.3829 12.5714H14.2857L20 18.2857L18.2857 20L12.5714 14.2857V13.3829L12.2629 13.0743C10.96 14.1829 9.26857 14.8571 7.42857 14.8571C5.45839 14.8571 3.56891 14.0745 2.17578 12.6814C0.78265 11.2882 0 9.39875 0 7.42857C0 5.45839 0.78265 3.56891 2.17578 2.17578C3.56891 0.78265 5.45839 0 7.42857 0ZM7.42857 2.28571C4.57143 2.28571 2.28571 4.57143 2.28571 7.42857C2.28571 10.2857 4.57143 12.5714 7.42857 12.5714C10.2857 12.5714 12.5714 10.2857 12.5714 7.42857C12.5714 4.57143 10.2857 2.28571 7.42857 2.28571Z"
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

					<!-- Primary Navigation -->
					<nav class="nav-header--primary" aria-labelledby="nav-header--primary__heading">
						<h2 id="nav-header--primary__heading" class="screen-reader-text">Primary Menu</h2>
						<?php create_custom_menu( "menu-1" ); ?>
					</nav>
				</div>

				<!-- Flyout Navigation -->
				<div class="nav-header--flyout__container">
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
								<?php create_custom_menu( "menu-1" ); ?>
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
				</div>
			</div>
		</header>