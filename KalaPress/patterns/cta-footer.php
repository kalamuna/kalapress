<?php
/**
 * Title: CTA Footer
 * Slug: kalapress/cta-footer
 * Categories: kalapress-featured, kalapress-footer
 * Keywords: featured, CTA, footer, kalapress
 * Block types: core/featured
 */

namespace KLPTheme;

?>

<!-- wp:media-text {"align":"full","mediaPosition":"right","mediaId":11037,"mediaLink":"<?php echo get_template_directory_uri(); ?>/src/images/placeholders/placeholder-image.jpgg","mediaType":"image","mediaWidth":34,"backgroundColor":"contrast","textColor":"base","className":"cta-footer has-bas-color"} -->
<div
	class="wp-block-media-text alignfull has-media-on-the-right is-stacked-on-mobile cta-footer has-bas-color has-base-color has-contrast-background-color has-text-color has-background"
	style="grid-template-columns:auto 34%">
	<div class="wp-block-media-text__content"><!-- wp:heading {"textColor":"base"} -->
		<h2 class="has-base-color has-text-color">Magna aliqua Ut enim ad minim veniam</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
			magna aliqua. Ut enim ad minim veniam. </p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-alternate"} -->
			<div class="wp-block-button is-style-alternate"><a class="wp-block-button__link wp-element-button">Become a
					Partner</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<figure class="wp-block-media-text__media"><img
			src="<?php echo get_template_directory_uri(); ?>/src/images/placeholders/placeholder-image.jpg" alt=""
			class="wp-image-11037 size-full" /></figure>
</div>
<!-- /wp:media-text -->
