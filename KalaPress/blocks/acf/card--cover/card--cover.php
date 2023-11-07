<?php
/**
 * Card Cover Block Template.
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
$class_name = 'card--cover';
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
$featured_item_button_text = get_field( 'featured_item_button_text' ); 

// Set a default image if the original post doesn't have one.
if ( empty( $featured_item_image ) ) {
    $featured_item_image = get_stylesheet_directory_uri() . '/src/images/placeholders/placeholder-image.jpg';
}

if ( empty( $featured_item_button_text ) ) {
  $featured_item_button_text = 'Read more';
}
?>

<article 
    <?php echo $anchor; ?> 
    class="card <?php echo esc_attr( $class_name ); ?>" 
    <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
  >
  <?php if( $featured_item ) { ?>
    <a href="<?php echo esc_html( $featured_item_link ); ?>" class="card__link">
      <div class="wp-block-cover card__content">
        <!-- Adds a gradient overlay on the background image -->
        <span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient has-black-to-transparent-gradient-background"></span>

        <!-- Give the image tag role presentation, so the alt text isn't the first thing that is read by screenreaders. -->
        <img class="wp-block-cover__image-background" alt="<?php echo ( $featured_item_image_alt ); ?>" src="<?php echo esc_url($featured_item_image) ?>" data-object-fit="cover" role="presentation">

        <div class="wp-block-cover__inner-container card__text-content">
          <h3 class="card__title"><?php echo esc_html( $featured_item->post_title ); ?></h3>

          <div class="wp-block-buttons">
            <div class="wp-block-button has-custom-font-size is-style-outline has-base-font-size">
              <span class="wp-block-button__link wp-element-button wp-block-button__link has-primary-1-color has-text-color has-background-background-color has-background">
                <?php echo esc_html( $featured_item_button_text ); ?>
              </span>
            </div>
          </div>
        </div> 

      </div>
    </a>
  <?php } else { ?>    
    <p><span class="dashicons dashicons-warning"></span> Choose a page or post to feature from the Block Settings.</p>
  <?php } ?>
</article>