<?php
// =========================================
//	SET UP THEME OPTIONS
// =========================================

namespace KLPTheme;

// Theme Option main headings

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => 'Theme Options',
		'menu_title' => 'Theme Options',
		'menu_slug'  => 'theme-global-settings',
		'capability' => 'edit_posts',
		'redirect'   => true // Makes it so clicking "Theme Options" actually opens whatever the first sub-option is. Otherwise it's a little confusing what the user is looking at there.
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Global Settings',
		'menu_title'  => 'Global',
		'parent_slug' => 'theme-global-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Header Settings',
		'menu_title'  => 'Header',
		'parent_slug' => 'theme-global-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Social Settings',
		'menu_title'  => 'Social',
		'parent_slug' => 'theme-global-settings',
	) );
}
?>
