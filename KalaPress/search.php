<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package kalapress
 */

namespace KLPTheme;

get_header();
?>

<main id="main-content">
	<div class="layout-container">
		<h1>

			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for %s', 'kalapress' ), '<span>' . get_search_query() . '</span>' );
			?>

		</h1>
		<p>

			<?php
			global $wp_query;
			if ( $wp_query->found_posts < 2 ) {
				$result = 'result';
			} else {
				$result = 'results';
			}
			echo $wp_query->found_posts . ' ' . $result . ' found.';
			?>

		</p>
	</div>

	<div class="page-layout page-layout--with-sidebar">
		<div class="page-layout--left">
			<div class="searchform">
				<form role="search" method="get" id="search-form" class="searchform__form" action="">
					<label for="search">Search</label>
					<input type="search" value="" name="s" id="search" placeholder="Search" />
					<input type="submit" value="Search" id="search-submit" value="Search">

					<?php
					if ( function_exists( '\facetwp_display' ) ) {
						echo \facetwp_display( 'facet', 'search_reset' );
					} else {
						error_log( 'The function facetwp_display() is not available. Please ensure the FacetWP plugin is activated.' );
					}
					?>

				</form>
			</div>

			<?php if ( have_posts() ) : ?>
				<ul class="search__list">

					<?php while ( have_posts() ) :
						the_post(); ?>

						<li class="search__list-item">
							<?php get_template_part( 'template-parts/content', 'search' ); ?>
						</li>

					<?php endwhile; ?>
				</ul>

				<?php
				the_posts_navigation();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
		<aside class="page-layout--sidebar">
			<div class="search__filters">
				<fieldset class="search-topics">
					<legend>
						<h2>Topic</h2>
					</legend>

					<?php
					if ( function_exists( '\facetwp_display' ) ) {
						echo \facetwp_display( 'facet', 'categories' );
					} else {
						error_log( 'The function facetwp_display() is not available. Please ensure the FacetWP plugin is activated.' );
					}
					?>

				</fieldset>
			</div>
		</aside>
	</div>
</main><!-- #main -->

<?php
get_footer();
