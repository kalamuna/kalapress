<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kalapress
 */

namespace KLPTheme;

?>

<div class="site-footer-cta">
	<?php dynamic_sidebar( 'footer-cta' ); ?>
</div>


<div id="site-footer-container" class="">

	<footer class="site-footer ">
		<div class="site-footer__top-container ">
			<div class="site-footer__top layout-container">
				<?php
				if ( is_active_sidebar( 'footer-1' ) ) :
					echo '<div>';
					dynamic_sidebar( 'footer-1' );
					echo '</div>';
				endif;
				if ( is_active_sidebar( 'footer-2' ) ) :
					echo '<div>';
					dynamic_sidebar( 'footer-2' );
					echo '</div>';
				endif;
				if ( is_active_sidebar( 'footer-3' ) ) :
					echo '<div>';
					dynamic_sidebar( 'footer-3' );
					echo '</div>';
				endif;
				if ( is_active_sidebar( 'footer-4' ) ) :
					echo '<div>';
					dynamic_sidebar( 'footer-4' );
					echo '</div>';
				endif;
				?>
				</section>
			</div>
		</div>

		<div class="site-footer__bottom-container">
			<?php
			if ( has_nav_menu( "menu-3" ) ) :
				echo '<div class="site-footer__bottom layout-container">';
				create_custom_menu( "menu-3" );
				echo '</div>';
			endif;

			if ( is_active_sidebar( 'footer-bottom' ) ) :
				echo '<div class="site-footer__bottom layout-container">';
				dynamic_sidebar( 'footer-bottom' );
				echo '</div>';
			endif;
			?>
		</div>

		<button class="scroll-to-top-button">
			<span class="screen-reader-text">Scroll to the top of the page</span>
		</button>

	</footer>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>
<?php
if ( have_rows( 'global_scripts', 'option' ) ) :
	while ( have_rows( 'global_scripts', 'option' ) ) :
		the_row();
		$script          = get_sub_field( 'script' );
		$script_location = get_sub_field( 'script_location' );
		if ( $script_location == 'body_end' && get_sub_field( 'enable_script' ) ) :
			echo "\n<!-- Theme Option Closing Body Scripts: " . get_sub_field( 'script_name' ) . " -->\n";
			echo $script . "\n";
		endif;
	endwhile;
endif;
?>

</body>
<?php
if ( have_rows( 'global_scripts', 'option' ) ) :
	while ( have_rows( 'global_scripts', 'option' ) ) :
		the_row();
		$script          = get_sub_field( 'script' );
		$script_location = get_sub_field( 'script_location' );
		if ( $script_location == 'footer' && get_sub_field( 'enable_script' ) ) :
			echo "\n<!-- Theme Option Footer Scripts: " . get_sub_field( 'script_name' ) . " -->\n";
			echo $script . "\n";
		endif;
	endwhile;
endif;
?>

</html>