<?php

namespace KLPTheme;

/**
 * Displays the entry footer for posts, showing categories, tags, comments link, and edit post link.
 * @TODO: // This is just a conversion from older code in previous Kalapress theme.
 * We will eventually move to block patterns and block templates. This is just a stop-gap.
 */
function display_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( esc_html__( ', ', KLP_TXT_DOMAIN ) );
		if ( $categories_list ) {
			printf( '<span class="cat-links categories">' . esc_html__( 'Topics: %1$s', KLP_TXT_DOMAIN ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', KLP_TXT_DOMAIN ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links article__tags">' . esc_html__( 'Tagged %1$s', KLP_TXT_DOMAIN ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', KLP_TXT_DOMAIN ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', KLP_TXT_DOMAIN ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
