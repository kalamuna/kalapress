<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kalapress
 */

namespace KLPTheme;

?>

<section class="no-results not-found">
	<header class="page-header">
		<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'kalapress' ); ?></h2>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'kalapress' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p>
				<?php esc_html_e( 'Unfortunately your search returned no results. Please refine your search criteria or try again later.', 'kalapress' ); ?>
			</p>
			<?php

		else :
			?>

			<p>
				<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kalapress' ); ?>
			</p>
			<?php

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
