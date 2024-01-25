<?php

namespace KLPTheme;

/**
 * Register widget area.
 * @TODO: // will be removed after adapting to FSE templates(patterns).
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function register_legacy_widget_areas() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar', KLP_TXT_DOMAIN ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Add widgets here.', KLP_TXT_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Header 1', KLP_TXT_DOMAIN ),
			'id' => 'header-1',
			'description' => esc_html__( 'Add widgets here.', KLP_TXT_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Header Bottom', KLP_TXT_DOMAIN ),
			'id' => 'header-bottom',
			'description' => esc_html__( 'Add widgets here.', KLP_TXT_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer 1', KLP_TXT_DOMAIN ),
			'id' => 'footer-1',
			'description' => esc_html__( 'Add widgets here.', KLP_TXT_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer 2', KLP_TXT_DOMAIN ),
			'id' => 'footer-2',
			'description' => esc_html__( 'Add widgets here.', KLP_TXT_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer 3', KLP_TXT_DOMAIN ),
			'id' => 'footer-3',
			'description' => esc_html__( 'Add widgets here.', KLP_TXT_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer Bottom', KLP_TXT_DOMAIN ),
			'id' => 'footer-bottom',
			'description' => esc_html__( 'Add widgets here.', KLP_TXT_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action( 'widgets_init', space( 'register_legacy_widget_areas' ) );
