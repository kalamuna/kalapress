<?php

namespace KLPTheme;

/**
 * Displays the post thumbnail.
 *
 * Checks if the current post is password protected, an attachment, or lacks a post thumbnail.
 * If none of these conditions are met, it displays the post thumbnail appropriately based on
 * the context of where it's called: differently on single pages than on lists or archives.
 *
 *  * @TODO: // This is just a conversion from older code in previous Kalapress theme.
 * We will eventually move to block patterns and block templates. This is just a stop-gap.
 */
function display_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) {
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

		<?php
	} else {
		?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'post-thumbnail',
				array(
					'alt' => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			);
			?>
		</a>

		<?php
	}
}
