<?php
/**
 * FAQ Block Template.
 *
 * @param	 array $block The block settings and attributes.
 * @param	 string $content The block inner HTML (empty).
 * @param	 bool $is_preview True during backend preview render.
 * @param	 int $post_id The post ID the block is rendering content against.
 *			This is either the post ID currently being displayed inside a query loop,
 *			or the post ID of the post hosting this block.
 * @param	 array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sample-faqs';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$faq_headline  = get_field( 'faq_headline' );
$faq_type      = get_field( 'faq_type' );
$output_schema = get_field( 'output_schema' );

// Query related posts
$args = [ 
	'post_type'      => 'faqs',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
	'order'          => 'ASC',
	'orderby'        => 'post_date',
	'tax_query'      => array(
		array(
			'taxonomy'         => 'faq_types',
			'field'            => 'term_id',
			'terms'            => $faq_type->term_id,
			'include_children' => false
		)
	)
];

$faqs = new WP_Query( $args );

?>
<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>" <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<?php
	if ( $faq_headline ) {
		echo '<h2>' . $faq_headline . '</h2>';
	}
	if ( $faqs->have_posts() ) : ?>
		<?php if ( $output_schema ) : ?>
			<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "FAQPage",
						"mainEntity": [
							<?php while ( $faqs->have_posts() ) :
								$faqs->the_post(); ?>
								{
									"@type": "Question",
									"name": "<?php echo addslashes( get_field( 'question', get_the_ID() ) ); ?>",
									"acceptedAnswer": {
									  "@type": "Answer",
									  "text": "<?php echo addslashes( get_field( 'answer', get_the_ID() ) ); ?>"
								}
							  }<?php if ( $faqs->current_post + 1 != $faqs->post_count ) {
								  echo ', ';
							  }
							endwhile; ?>]
					  }
					</script>
		<?php endif;
		echo '<div class="faqs__wrapper">';
		while ( $faqs->have_posts() ) :
			$faqs->the_post();
			echo '<details class="faqs__item">';
			echo '<summary class="faqs__question">';
			echo '<h3>' . get_field( 'question', get_the_ID() ) . '</h3>';
			echo '</summary>';
			echo '<div class="faqs__answer">' . get_field( 'answer', get_the_ID() ) . '</div>';
			echo '</details>';
		endwhile;
		echo '</div>';
	endif;
	wp_reset_query()
		?>

</div>