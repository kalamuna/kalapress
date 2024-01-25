<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package kalapress
 */

get_header();
?>

<?php if ( ! empty( get_field( '404_options', 'option' ) ) ) :
	// If the Theme Option for what page to use for 404s has been set, then let's redirect to that.
	// Set the post ID to the one set in theme options, which will pull in the meta fields set on that page.
	global $post;
	$post = get_post( get_field( '404_options', 'option' ), OBJECT );
	setup_postdata( $post );
	?>

	<main class="page-layout" id="main-content">

		<?php $the_content = apply_filters( 'the_content', get_the_content() );

		if ( ! empty( $the_content ) ) : ?>
			<section class="error-404 not-found">
				<?php echo $the_content; ?>
			</section>
		<?php endif; ?>

	</main>

	<?php wp_reset_postdata(); // Now that we're done pulling in the theme option page, reset the query so it doesn't get weird up in here. ?>

<?php else : ?>

	<main class="page-layout" id="main-content">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title">
					<?php esc_html_e( 'It looks like the page you were looking for does not exist. What a shame!', 'kalapress' ); ?>
				</h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p>
					<?php esc_html_e( 'Please use navigation or search to get where you want. We are sure your efforts will be more fruitful this time.', 'kalapress' ); ?>
				</p>

				<?php
				//get_search_form();
				?>


			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main>

<?php endif;

get_footer();
