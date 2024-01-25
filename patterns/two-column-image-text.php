<?php
/**
 * Title: Two Column Image + Text Block (60/40)
 * Slug: kalapress/two-column-image-text
 * Categories: kalapress, kalapress-featured, kalapress-columns, kalapress-media
 * Keywords: featured, columns, kalapress
 * Block types: core/featured
 */

$image_url = KLP_URI . 'src/images/placeholders/placeholder-image.jpg';

echo '<!-- wp:media-text {"align":"","mediaPosition":"right","mediaId":177,"mediaLink":"' . $image_url . '","mediaType":"image","mediaWidth":40,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|x-small","top":"var:preset|spacing|x-small"}}},"className":"media-text\u002d\u002dcta"} -->';
?>
<div class="wp-block-media-text has-media-on-the-right is-stacked-on-mobile media-text--cta"
	style="margin-top:var(--wp--preset--spacing--x-small);margin-bottom:var(--wp--preset--spacing--x-small);grid-template-columns:auto 40%">
	<div class="wp-block-media-text__content"><!-- wp:heading -->
		<h2>Two Column Image + Text Block</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>This block pattern uses Gutenberg's Media &amp; Text block. You can change the width of the image column by
			increasing the Media Width under Block Settings. To move the image to the left side of the block, select "Show
			media on the left" button in the toolbar.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
			<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button"
					href="//wordpress.org/documentation/article/media-text-block/" target="_blank">Learn more</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<figure class="wp-block-media-text__media"><img
			src="<?php echo KLP_URI; ?>/src/images/placeholders/placeholder-image.jpg" alt=""
			class="wp-image-177 size-full" /></figure>
</div>
<!-- /wp:media-text -->
