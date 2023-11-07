<?php
/**
 * Kalapress Social Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *		  This is either the post ID currently being displayed inside a query loop,
 *		  or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'social-links';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$socials = get_field('social_media_accounts', 'option');
?>
<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>" <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<?php 
	if ( $socials ) :
		foreach ( $socials as $account ) :
			echo '<a href="' . $account['link'] . '" class="social-link" rel="noreferrer" target="_self"><span class="screen-reader-text">' . $account['name'] . '</span><img src="' . $account['icon']['url'] . '" class="social-link-icon" alt=""></a>';
		endforeach;
	else:
		echo 'The icons and links will automatically be output from Theme Options->Social, there is nothing to configure within this block.';
	endif; ?>
</div>