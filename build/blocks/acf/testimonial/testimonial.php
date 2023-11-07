<?php
/**
 * Testimonial Block Template.
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
$class_name = 'testimonial';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text             = get_field( 'testimonial' ) ?: 'Your testimonial here...';
$author           = get_field( 'testimonial_author' ) ?: 'Author name';
$author_role      = get_field( 'testimonial_role' ) ?: 'Author role';
$image            = get_field( 'testimonial_image' );

?>

<div 
  <?php echo $anchor; ?> 
  class="<?php echo esc_attr( $class_name ); ?>" 
  <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
>
  <blockquote class="wp-block-quote testimonial__blockquote">
    <p class="testimonial__text"><?php echo esc_html( $text ); ?></p>

    <footer>
      <?php if( $image ): ?>
        <figure class="wp-block-image is-resized is-style-rounded testimonial__media">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="66" height="66"/>
        </figure>
      <?php endif; ?>

      <cite>
        <strong><?php echo esc_html( $author ); ?></strong>
        <?php if( $author_role ): ?><br><p><small><?php echo esc_html( $author_role ); ?></small></p><?php endif; ?>
      </cite>
    </footer>
  </blockquote>
  
</div>
