<?php

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