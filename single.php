<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kalapress
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	?>

	<main id="main-content">
		<?php
		get_template_part( 'template-parts/hero' );
		?>

		<div class="page-layout">
			<div class="page-layout--full">
				<?php
				get_template_part( 'template-parts/content', get_post_type() );
				/*
										the_post_navigation(
											array(
												'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'kalapress' ) . '</span> <span class="nav-title">%title</span>',
												'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'kalapress' ) . '</span> <span class="nav-title">%title</span>',
											)
										);
										*/
				?>
			</div>
		</div>
	</main><!-- #main -->

	<?php
endwhile; // End of the loop.

get_footer();
