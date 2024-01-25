<?php
/**
 * Title: Default Footer
 * Slug: kalapress/footer-default
 * Categories: kalapress-footer
 * Keywords: footer, default, kalapress
 * Block types: core/footer
 * Inserter: false
 */
?>
<?php

use function KLPTheme\get_display_custom_menu;

$image_url = esc_url( KLP_URI . '/src/images/logo-tagline-vertical-dark.svg' );
$acf_social_links = function_exists( 'get_field' ) ? '<!-- wp:acf/social-links {"name":"acf/social-links","mode":"preview"} /-->' : '';
$gravity_form = class_exists( 'GFForms' ) ? '<!-- wp:gravityforms/form {"formId":"2","title":false,"inputPrimaryColor":"#204ce5"} /-->' : '';
$custom_menu = has_nav_menu( "menu-3" ) ? get_display_custom_menu( "menu-3" ) : ''; // Need to wrap this in a custom html block to avoid the block validation error in the console on the editor side. Otherwise it works fine on the front end.
$current_year = date( "Y" );
?>

<!-- wp:group {"className":"site-footer__top-container"} -->
<div class="wp-block-group site-footer__top-container">

	<!-- wp:group {"className":"site-footer__top,layout-container"} -->
	<div class="wp-block-group site-footer__top layout-container">

		<!-- wp:group {"layout":{"type":"constrained","justifyContent":"left"}} -->
		<div class="wp-block-group">

			<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"footer-logo"} -->
			<figure class="wp-block-image size-large footer-logo">
				<img src="<?php echo $image_url; ?>"
					alt="<?php echo esc_attr( 'Kalamuna ' . __( 'logo (vertical)', KLP_TXT_DOMAIN ) ); ?>" />
			</figure>
			<!-- /wp:image -->

		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Connect With Us', KLP_TXT_DOMAIN ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"footer-email"} -->
			<p class="footer-email">
				<a href="mailto:support@kalamuna.com"><?php esc_html_e( 'Send Us a Message', KLP_TXT_DOMAIN ); ?></a>
			</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"footer-phone"} -->
			<p class="footer-phone">
				<a href="tel:+1-800-674-7784">1-800-674-7784</a>
			</p>
			<!-- /wp:paragraph -->

			<?php if ( ! empty( $acf_social_links ) ) : ?>
				<?php echo $acf_social_links; ?>
			<?php endif; ?>

		</div>
		<!-- /wp:group -->

		<?php if ( ! empty( $gravity_form ) ) : ?>
			<?php echo $gravity_form; ?>
		<?php endif; ?>

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:group {"className":"site-footer__bottom-container"} -->
<div class="wp-block-group site-footer__bottom-container">

	<!-- wp:group {"className":"site-footer__bottom,layout-container"} -->
	<div class="wp-block-group site-footer__bottom layout-container">

		<?php if ( ! empty( $custom_menu ) ) : ?>
			<!-- wp:group -->
			<div class="wp-block-group">

				<?php // Not a cool way to wrap the php inside the html block markup. Just a band aid( since the inserter is off and user don't see it in the editor ). Better to use a custom block or something... ?>
				<!-- wp:html -->
				<?php echo $custom_menu; ?>
				<!-- /wp:html -->

			</div>
			<!-- /wp:group -->
		<?php endif; ?>

		<!-- wp:group -->
		<div class="wp-block-group">

			<!-- wp:paragraph -->
			<p>© Kalamuna <?php echo esc_html( $current_year ); ?></p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
