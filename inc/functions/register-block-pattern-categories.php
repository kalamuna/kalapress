<?php

namespace KLPTheme;

/**
 * Register block pattern categories by using an array of give categories(names and labels).
 *
 *  * @TODO: // this remains here as function until the class implementation is debugged. @see KLPTheme\Core\Engine\HandleBlockPatternCategories
 *
 * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/#register_block_pattern_category
 *
 */
function register_block_pattern_categories() {
	$categories = [ 
		[ 
			'name' => KLP_SLUG,
			'label' => __( KLP_NAME, KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-about',
			'label' => __( 'About', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-buttons',
			'label' => __( 'Buttons', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-call-to-action',
			'label' => __( 'Call to Action', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-columns',
			'label' => __( 'Columns', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-contact',
			'label' => __( 'Contact', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-embed',
			'label' => __( 'Embed', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-featured',
			'label' => __( 'Featured', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-footer',
			'label' => __( 'Footer', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-gallery',
			'label' => __( 'Gallery', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-header',
			'label' => __( 'Header', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-media',
			'label' => __( 'Media', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-portfolio',
			'label' => __( 'Portfolio', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-posts',
			'label' => __( 'Posts', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-query',
			'label' => __( 'Query', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-reusable',
			'label' => __( 'Reusable', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-services',
			'label' => __( 'Services', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-team',
			'label' => __( 'Team', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-testimonials',
			'label' => __( 'Testimonials', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-text',
			'label' => __( 'Text', KLP_TXT_DOMAIN ),
		],
		[ 
			'name' => KLP_SLUG . '-widgets',
			'label' => __( 'Widgets', KLP_TXT_DOMAIN ),
		],
	];

	foreach ( $categories as $category ) {
		register_block_pattern_category( $category['name'], $category );
	}
}
add_action( 'after_setup_theme', space( 'register_block_pattern_categories' ) );

/**
 * Unregister core block pattern categories.
 *
 * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/#unregister_block_pattern_category
 *
 */
function unregister_core_block_pattern_categories() {
	$categories = [ 
		'featured',
		'query',
		'columns',
		'text',
		'posts',
		'call-to-action',
		'footer',
		'media',
		'portfolio',
		'about',
		'contact',
		'team',
		'testimonials',
		'services',
		'header',
		'gallery',
		'buttons',
	];

	foreach ( $categories as $category ) {
		unregister_block_pattern_category( $category );
	}
}
add_action( 'init', space( 'unregister_core_block_pattern_categories' ) );
