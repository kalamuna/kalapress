<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kalapress
 */

$full_src = get_the_post_thumbnail_url( get_the_ID(), 'card-thumbnail' );
if ( ! get_the_post_thumbnail_url() ) {
	$full_src = get_stylesheet_directory_uri() . '/images/placeholders/placeholder-image.jpg';
}
$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
?>

<article id="post-<?php the_ID(); ?>" class="search__result">
	<div class="search__result__content">
		<figure class="wp-block-post-featured-image search__result__media">
			<img src="<?php echo $full_src; ?>" alt="<?php echo $alt; ?>" />
		</figure>

		<div class="search__result__text-content">
			<div class="search__result__meta">
				<span class="search__result__meta--categories">
					<?php echo get_post_type_object( get_post_type() )->labels->singular_name; ?>
				</span>
				<span class="search__result__meta--date">
					<?php echo get_the_date( 'F j, Y' ); ?>
				</span>
			</div>

			<a href="<?php the_permalink() ?>">
				<h2>
					<?php the_title(); ?>
				</h2>
			</a>
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
