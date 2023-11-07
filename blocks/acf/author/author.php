<?php
/**
 * Author Block Template.
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
$class_name = 'author-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$author = get_field('author');
?>

<div 
  <?php echo $anchor; ?> 
  class="<?php echo esc_attr( $class_name ); ?>" 
  <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
>
  <?php echo get_the_post_thumbnail($author, 'thumbnail', array('class'=>'author-block__photo')); ?>
  
  <div class="author-block__content">
    <p><a href="<?php echo get_the_permalink($author); ?>" class="author-block__link"><?php echo get_the_title($author); ?></a></p>
    <p class="author-block__title"><?php echo get_field( 'title', $author ); ?></p>
    <p class="author-block__excerpt"><?php echo get_the_excerpt($author); ?></p>
    <!-- TO DO: More Posts button when the archive template is complete -->
  </div>
</div>