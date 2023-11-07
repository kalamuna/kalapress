<?php

namespace KLPTheme;

function register_faq_types_taxonomy() {
	$singular = 'FAQ Type';
	$plural   = 'FAQ Types';
	$labels   = array(
		'name'                       => $plural,
		'Taxonomy General Name',
		'singular_name'              => $singular,
		'Taxonomy Singular Name',
		'menu_name'                  => $plural,
		'all_items'                  => 'All ' . $plural,
		'parent_item'                => 'Parent ' . $singular,
		'parent_item_colon'          => 'Parent ' . $singular . ':',
		'new_item_name'              => 'New ' . $singular . ' Name',
		'add_new_item'               => 'Add New ' . $singular,
		'edit_item'                  => 'Edit ' . $singular,
		'update_item'                => 'Update ' . $singular,
		'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
		'search_items'               => 'Search ' . $plural,
		'add_or_remove_items'        => 'Add or remove' . $plural,
		'choose_from_most_used'      => 'Choose from the most used ' . $plural,
		'popular_items'              => 'Popular ' . $plural,
		'not_found'                  => 'No ' . $plural . ' found',
		'view_item'                  => 'View' . $singular,
		'not_found_in_trash'         => 'No' . $plural . ' found in Trash',
	);
	//$rewrite  = array(
	//	'slug'         => 'audience',
	//	'with_front'   => false,
	//	'hierarchical' => false,
	//);
	$args = array(
		//'description'        => 'Description goes here.',
		'labels'             => $labels,
		'hierarchical'       => true,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_quick_edit' => true,
		'meta_box_cb'        => true,
		'show_admin_column'  => true,
		'show_in_nav_menus'  => true,
		'show_tagcloud'      => false,
		'show_in_rest'       => true,
		'rewrite'            => false,
		'query_var'          => true,
		'args'               => array( 'orderby' => 'term_order' ),
	);
	register_taxonomy(
		'faq_types',
		array(
			'faqs',
		),
		$args
	);
}
