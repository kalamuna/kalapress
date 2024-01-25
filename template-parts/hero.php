<?php
/**
 * Template part for the internal page hero.
 *
 * Depending on the template, different variables will be used to
 * pull in the title and/or subtitle.
 *
 * @package kalapress
 */

use function KLPTheme\display_breadcrumbs;
use function KLPTheme\display_posted_on;

// Variables for Single Pages & Posts.
if ( is_singular() ) {

	// If no heading text is provided then the heading will use the Page title.
	$hero_heading = get_field( 'hero_heading' );
	if ( ! $hero_heading ) :
		$hero_heading = get_the_title();
	endif;
	$hero_subheading = get_field( 'hero_subheading' );
	$show_hero_image = get_field( 'show_hero_image' ); // hide the hero image if this is selected.
	$full_src = get_the_post_thumbnail_url( get_the_ID(), 'hero-banner' );
	$alt = get_post_meta( $full_src, '_wp_attachment_image_alt', true );
}

// Variables for Post Archives.
elseif ( is_post_type_archive() && is_home() ) {
	$hero_heading = get_post_type_labels( get_queried_object() )->name;
	$hero_subheading = get_field( 'hero_subheading' );
}

// Variables for Taxonomy Templates.
elseif ( is_tax() ) {
	$hero_heading = get_queried_object()->name;
	$hero_subheading = $term->description;
}

// Variables for Taxonomies.
elseif ( is_category() ) {
	$hero_heading = get_queried_object()->name;
	$hero_subheading = get_field( 'hero_subheading' );
	$full_src = get_stylesheet_directory_uri() . '/images/placeholders/placeholder.jpg';
}

// Load values and assign defaults.
$term = get_queried_object();
$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );


$hero_subheading = get_field( 'hero_subheading' );
$show_hero = get_field( 'show_hero' );
?>

<div class="layout-container">
	<?php display_breadcrumbs(); ?>
</div>

<?php
// Layout of it's a blog post.
if ( 'post' === get_post_type() && has_post_thumbnail() ) : ?>
	<div class="layout-container hero hero--single-post">
		<?php
		echo '<figure class="hero__thumbnail">';
		the_post_thumbnail();
		echo '</figure>'; ?>
		<!-- Page title. -->
		<h1 class="hero__heading has-text-align-center has-xx-large-font-size alignnarrow">
			<?php echo $hero_heading; ?>
		</h1>
		<div class="has-text-align-center">
			<?php
			/* Check to see if a custom "author block" is present on the page */
			if ( has_block( 'acf/author' ) ) :

				/* Parse all the blocks to get their contents. */
				$blocks = parse_blocks( $post->post_content );

				foreach ( $blocks as $block ) {

					/* The custom block name */
					if ( 'acf/author' === $block['blockName'] ) {
						/* This block has a post object field looking for the Custom Post
																																													Type set to return the ID */
						$author_id = $block['attrs']['data']['author'];

						/* And with that ID we can use regular functions to return data */
						echo 'By <a href="' . get_the_permalink( $author_id ) . '" class="hero__author-link">' . get_the_title( $author_id ) . '</a> | ';

						break;

					}

				}
			endif;
			?>
			<?php display_posted_on(); ?>
		</div>
	</div>
<?php elseif ( ! empty( $show_hero_image ) ) :
	?>

	<!-- The hero block is built from WP's Cover block. -->
	<div class="wp-block-cover alignfull hero">

		<!-- Adds a decorative overlay over the image. -->
		<!-- <span aria-hidden="true" class="wp-block-cover__background"></span> -->
		<img class="wp-block-cover__image-background" alt="<?php echo $alt; ?>" src="<?php echo $full_src; ?>"
			data-object-fit="cover" />

		<!-- The content within the hero.  -->
		<div class="wp-block-cover__inner-container">
			<div class="hero__text-content">
				<!-- Display a subtitle if there is one. -->
				<?php if ( ! empty( $hero_subheading ) ) : ?>
					<p class="hero__subheading">
						<?php echo $hero_subheading; ?>
					</p>
				<?php endif; ?>

				<!-- Page title. -->
				<h1 class="has-text-align-left">
					<?php echo $hero_heading; ?>
				</h1>
			</div>
		</div>
	</div>

	<!-- If this field is unchecked, use only the headings will display. -->
<?php else : ?>
	<div class="layout-container hero hero--single-post">
		<!-- Display a subtitle if there is one. -->
		<?php if ( ! empty( $hero_subheading ) ) : ?>
			<p class="hero__subheading">
				<?php echo $hero_subheading; ?>
			</p>
		<?php endif; ?>

		<!-- Page title. -->
		<h1 class="hero__heading has-text-align-left">
			<?php echo $hero_heading; ?>
		</h1>
		<!-- Team member / author title -->
		<?php
		if ( 'team_member' === get_post_type() && get_field( 'title' ) ) :
			echo '<p class="hero__job-title has-text-color has-secondary-font-family has-large-font-size">' . get_field( 'title' ) . '</p>';
		endif;
		?>
	</div>
<?php endif; ?>
