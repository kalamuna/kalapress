<?php
/**
 * The template for displaying the Blog archive.
 * is_home() is dependent on the site’s "Front page displays" Reading Settings ‘show_on_front’ and ‘page_for_posts’.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kalapress
 */

namespace KLPTheme;

get_header();
?>

<main id="main-content">
	<div class="layout-container">
		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
	</div>

	<!-- The hero block is built from WP's Cover block. -->
	<div class="wp-block-cover alignfull hero hero--research">
		<!-- Adds a decorative overlay over the image. -->
		<span aria-hidden="true"
			class="wp-block-cover__background has-secondary-1-background-color has-background-dim-50 has-background-dim"></span>

		<!-- The content within the hero.  -->
		<div class="wp-block-cover__inner-container">
			<!-- Page title. -->
			<h1><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="page-layout">
		<div class="page-layout--full">
			<?php if ( have_posts() ) : ?>
				<ul class="wp-block-post-template">
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

			endif;
			?>
			</ul>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
