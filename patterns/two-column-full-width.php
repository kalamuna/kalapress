<?php
/**
 * Title: Two Column Image + Text Block, Full Width
 * Slug: kalapress/two-column-full-width
 * Categories: kalapress, kalapress-featured, kalapress-columns
 * Keywords: featured, banner, kalapress
 * Block types: core/featured
 */

?>
<!-- wp:cover {"url":"<?php echo get_template_directory_uri(); ?>/src/images/placeholders/placeholder-banner.png","id":342,"dimRatio":0,"focalPoint":{"x":0,"y":1},"minHeight":571,"contentPosition":"center center","templateLock":"contentOnly","align":"full","className":"has-quartary-background-color has-background","style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"}}}} -->
<div class="wp-block-cover alignfull has-quartary-background-color has-background"
	style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:var(--wp--preset--spacing--medium);min-height:571px">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img
		class="wp-block-cover__image-background wp-image-342" alt=""
		src="<?php echo get_template_directory_uri(); ?>/src/images/placeholders/placeholder-banner.png"
		style="object-position:0% 100%" data-object-fit="cover" data-object-position="0% 100%" />
	<div class="wp-block-cover__inner-container"><!-- wp:columns {"className":"container"} -->
		<div class="wp-block-columns container"><!-- wp:column {"width":"45%"} -->
			<div class="wp-block-column" style="flex-basis:45%">
				<!-- wp:heading {"textColor":"contrast","fontSize":"xxx-large"} -->
				<h2 class="has-contrast-color has-text-color">Two Column Image +<br />Text Block (Full Width)</h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"textColor":"contrast"} -->
				<p class="has-contrast-color has-text-color has-medium-font-size">This block pattern leverages Gutenberg's Cover
					block. You can change the background image by selecting <strong>Replace</strong> from the popover toolbar. To
					unlock additional Cover Block settings, click <strong>Modify</strong> in the popover toolbar.</p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons -->
				<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-alternate"} -->
					<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button"
							href="//wordpress.org/documentation/article/cover-block/" target="_blank">Read more</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column"></div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
</div>
<!-- /wp:cover -->
