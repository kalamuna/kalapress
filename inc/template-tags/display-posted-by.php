<?php

namespace KLPTheme;

/**
 * Displays the byline of the post, indicating the author.
 *
 *  * @TODO: // This is just a conversion from older code in previous Kalapress theme.
 * We will eventually move to block patterns and block templates. This is just a stop-gap.
 */
function display_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', KLP_TXT_DOMAIN ),
		'<span class="article__author vcard"><a class="article__author-link" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="article__byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
