<?php
/**
 * Title: Query Grid
 * Slug: kalapress/query--grid
 * Categories: kalapress, kalapress-query, kalapress-posts
 * Keywords: posts, query, kalapress
 * Block types: core/featured
 */

namespace KLPTheme;

?>
<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"}}},"className":"query query\u002d\u002dgrid"} -->
<div class="wp-block-group query query--grid"
	style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:var(--wp--preset--spacing--medium)">
	<!-- wp:heading {"textAlign":"left"} -->
	<h2 class="has-text-align-left">Posts Grid</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":3,"query":{"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","sticky":"","perPage":"6"},"displayLayout":{"type":"flex","columns":3},"layout":{"type":"default"}} -->
	<div class="wp-block-query"><!-- wp:post-template -->
		<!-- wp:group {"tagName":"article","className":"card"} -->
		<article class="wp-block-group card"><!-- wp:group {"className":"card__contents","layout":{"type":"default"}} -->
			<div class="wp-block-group card__contents">
				<!-- wp:post-featured-image {"isLink":true,"className":"card__media"} /-->

				<!-- wp:group {"className":"card__text-content","layout":{"type":"constrained"}} -->
				<div class="wp-block-group card__text-content">
					<!-- wp:group {"className":"card__meta","layout":{"type":"default"}} -->
					<div class="wp-block-group card__meta"><!-- wp:post-terms {"term":"category"} /-->

						<!-- wp:post-date {"format":"F j, Y","isLink":true} /-->
					</div>
					<!-- /wp:group -->

					<!-- wp:post-title {"level":3,"isLink":true} /-->

					<!-- wp:post-excerpt /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</article>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|small"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--small)"><!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">See more of our work</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
