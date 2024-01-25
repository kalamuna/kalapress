<?php
/**
 * Title: Contact columns with Gravity form + text
 * Slug: kalapress/contact
 * Categories: kalapress, kalapress-contact
 * Block types: core/featured
 * Viewport Width: 1412
 */

?>
<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|small"}}}} -->
<div class="wp-block-columns"
	style="margin-top:var(--wp--preset--spacing--small);margin-bottom:var(--wp--preset--spacing--small)">
	<!-- wp:column {"width":"66.66%"} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:gravityforms/form {"formId":"3","title":false,"description":false} /-->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"33.33%"} -->
	<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading {"fontSize":"medium-large"} -->
		<h2 class="has-medium-large-font-size"><a
				href="https://www.google.com/maps/place/Kalamuna+Inc/@37.8028069,-122.2751097,17z/data=!3m1!4b1!4m5!3m4!1s0x808f80b3dc1faa5b:0x80851bf1900c0d06!8m2!3d37.8028027!4d-122.272921"
				target="_blank" rel="noreferrer noopener">Oakland</a></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>1111 Broadway, suite 300<br>Oakland, CA, 94607</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":5,"fontSize":"medium-large"} -->
		<h5 class="has-medium-large-font-size"><a
				href="https://www.google.com/maps/place/192+Spadina+Ave.,+Toronto,+ON+M5T+3A4/@43.6499692,-79.3996756,17z/data=!3m1!4b1!4m5!3m4!1s0x882b34dca6232863:0x297d8e20c1df4eae!8m2!3d43.6499653!4d-79.3974869"
				target="_blank" rel="noreferrer noopener">Toronto</a></h5>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|x-small"}}}} -->
		<p style="margin-bottom:var(--wp--preset--spacing--x-small)">192 Spadina Ave<br>Toronto, ON, M5T 2C2</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"fontFamily":"secondary"} -->
		<p class="has-secondary-font-family"><a href="mailto:hello@kalamuna.com">hello@kalamuna.com</a></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"fontFamily":"secondary"} -->
		<p class="has-secondary-font-family" style="margin-bottom:var(--wp--preset--spacing--small)"><a
				href="tel:+18006747784">1.800.674.7784</a></p>
		<!-- /wp:paragraph -->

		<!-- wp:acf/social-links {"name":"acf/social-links","mode":"preview"} /-->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->
