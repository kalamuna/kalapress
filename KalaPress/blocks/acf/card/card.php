<?php
/**
 * Card Cover Block Template.
 * This block displays a post in a Card 
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'card';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
global $post;
$featured_item = get_field( 'featured_item' ); 
$featured_item_link = get_post_permalink( $featured_item );
$featured_item_image = get_the_post_thumbnail_url( $featured_item, 'card-thumbnail' );
$featured_item_image_alt = get_post_meta(get_post_thumbnail_id($featured_item), '_wp_attachment_image_alt', true);
$featured_item_excerpt = get_the_excerpt( $featured_item );
$categories = get_the_category( $featured_item );
$categories_string = join(', ', wp_list_pluck($categories, 'name'));

// Set a default image if the original post doesn't have one.
if ( empty( $featured_item_image ) ) {
  $featured_item_image = get_stylesheet_directory_uri() . '/src/images/placeholders/placeholder-image.jpg';
}

?>

<div class="card__container">
  <article 
    <?php echo $anchor; ?> 
    class="<?php echo esc_attr( $class_name ); ?>" 
    <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
  >
    <?php if( $featured_item ) { ?>
      <a href="<?php echo esc_html( $featured_item_link ); ?>"  class="card__link">
        <div class="card__content">

          <?php if( $featured_item_image ): ?>
            <figure class="wp-block-post-featured-image card__media">
              <!-- Give the image tag role presentation, so the alt text isn't the first thing that is read by screenreaders. -->
              <img alt="<?php echo ( $featured_item_image_alt ); ?>" src="<?php echo ( $featured_item_image ); ?>" role="presentation" />
            </figure>	
          <?php endif; ?>

          <div class="wp-block-group wp-block-media-text__content card__text-content">

            <?php if ( ! empty( $categories ) ): ?>
              <div class="card__meta">
                <?php echo $categories_string; ?>
              </div>
            <?php endif; ?>

            <h3><?php echo esc_html( $featured_item->post_title ); ?></h3>

          </div>
        </div>
      </a>
      <?php } else { ?>    
        <p><span class="dashicons dashicons-warning"></span> Choose a page or post to feature from the Block Settings.</p>
      <?php } ?>
  </article>
</div>