<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KLPTheme
 */

use function KLPTheme\display_favicons;
use function KLPTheme\display_meta_tags;

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<?php display_meta_tags(); ?>
	<?php display_favicons(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'mouse-input' ); ?>>

	<?php wp_body_open(); ?>

	<div id="page" class="site">

		<header id="site-header" class="site-header">

			<a class="screen-reader-text skip-link" href="#main-content">
				<?php esc_html_e( 'Skip to content', KLP_TXT_DOMAIN ); ?>
			</a>

			<div class="site-header__container">

				<!-- site logo -->
				<?php include KLP_DIR . '/template-parts/header/site-logo.php'; ?>

				<div class="site-header__content">
					<!-- Utility Navigation -->
					<?php include KLP_DIR . '/template-parts/header/navigation-utility.php'; ?>

					<!-- Primary Navigation -->
					<?php include KLP_DIR . '/template-parts/header/navigation-primary.php'; ?>

				</div>

				<!-- Flyout Navigation -->
				<div class="nav-header--flyout__container">

					<?php include KLP_DIR . '/template-parts/header/navigation-flyout.php'; ?>

				</div>
			</div>
		</header>
