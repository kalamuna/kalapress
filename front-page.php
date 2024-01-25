<?php
/**
 * The template for displaying the homepage.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-front-page-templates/
 *
 * @package kalapress
 */

get_header();
?>
<main id="main-content">
	<div class="page-layout">
		<div class="page-layout--full">
			<?php if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
				the_posts_navigation();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</div>
</main>
<?php
get_footer();
