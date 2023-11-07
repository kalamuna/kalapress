<?php

namespace KLPTheme;


function register_faqs_post_type() {
	$singular = 'FAQ';
	$plural   = 'FAQs';
	$labels   = array(
		'name'                  => $plural,
		'Post Type General Name',
		'singular_name'         => $singular,
		'Post Type Singular Name',
		'menu_name'             => $plural,
		'name_admin_bar'        => $singular,
		'archives'              => $singular . ' Archives',
		'attributes'            => $singular . ' Attributes',
		'parent_item_colon'     => 'Parent ' . $singular . ':',
		'all_items'             => 'All ' . $plural,
		'add_new_item'          => 'Add New ' . $singular,
		'add_new'               => 'New ' . $singular,
		'new_item'              => 'New ' . $singular,
		'edit_item'             => 'Edit ' . $singular,
		'update_item'           => 'Update ' . $singular,
		'view_item'             => 'View' . $singular,
		'view_items'            => 'View ' . $plural,
		'search_items'          => 'Search ' . $plural,
		'not_found'             => 'No ' . $plural . ' found',
		'not_found_in_trash'    => 'No' . $plural . ' found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into ' . $singular,
		'uploaded_to_this_item' => 'Uploaded to this ' . $singular,
		'items_list'            => $plural . ' list',
		'items_list_navigation' => $plural . ' list navigation',
		'filter_items_list'     => 'Filter ' . $plural . ' list',
	);
	$rewrite  = array(
		'slug'       => 'faqs',
		'with_front' => false,
		'pages'      => true,
		'feeds'      => true,
	);
	$args     = array(
		'label'               => $singular,
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'revisions' ),
		'taxonomies'          => array( 'faq_types' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'query_var'           => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-editor-help',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => null, // Some intelligent reminder or instruction
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'faqs', $args );
}
