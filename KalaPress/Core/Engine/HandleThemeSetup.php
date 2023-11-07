<?php
/**
 * Theme setup class file.
 * This file is responsible for setting up the theme.
 * @TODO: Haven't been optimized yet and is next in line for refactoring.
 *
 * @package Kalapress
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

class HandleThemeSetup {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'kalapress_setup' ) );
		add_action( 'after_setup_theme', array( $this, 'gutenberg_editor_setup' ) );
		add_action( 'after_setup_theme', array( $this, 'kalapress_content_width' ), 0 );
		add_action( 'widgets_init', array( $this, 'kalapress_widgets_init' ) );
		add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ) );
		add_filter( 'excerpt_more', array( $this, 'custom_excerpt_more' ), 11 );
		add_filter( 'should_load_remote_block_patterns', '__return_false' ); // Remove default patterns.
	}

	function custom_excerpt_more( $excerpt ) {
		$excerpt = '...';
		return $excerpt;
	}
	function custom_excerpt_length( $length ) {
		return 28;
	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function kalapress_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'kalapress' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'kalapress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Header 1', 'kalapress' ),
				'id'            => 'header-1',
				'description'   => esc_html__( 'Add widgets here.', 'kalapress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Header Bottom', 'kalapress' ),
				'id'            => 'header-bottom',
				'description'   => esc_html__( 'Add widgets here.', 'kalapress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 1', 'kalapress' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here.', 'kalapress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'kalapress' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Add widgets here.', 'kalapress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 3', 'kalapress' ),
				'id'            => 'footer-3',
				'description'   => esc_html__( 'Add widgets here.', 'kalapress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Bottom', 'kalapress' ),
				'id'            => 'footer-bottom',
				'description'   => esc_html__( 'Add widgets here.', 'kalapress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}

	function kalapress_content_width() {
		$GLOBALS['content_width'] = 1200;
	}

	function gutenberg_editor_setup() {
		add_theme_support( 'align-wide' );

		add_theme_support( 'editor-styles' );

		// register_block_pattern_category(
		// 	'kalapress',
		// 	array( 'label' => __( 'Kalapress', 'kalapress' ) )
		// );
	}


	function kalapress_setup() {

		load_theme_textdomain( 'kalapress', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'hero-banner', '1920', '480', true ); /* 4:1 hero banners */
		add_image_size( 'card-thumbnail', '1024', '682', true ); /* 3:2 thumbnails */

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'kalapress' ),
				'menu-2' => esc_html__( 'Secondary', 'kalapress' ),
				'menu-3' => esc_html__( 'Footer Utility', 'kalapress' ),
				'menu-4' => esc_html__( 'Header Utility', 'kalapress' ),
				'menu-5' => esc_html__( 'Eyebrow', 'kalapress' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// enable FSE features
		add_theme_support( 'block-templates' );
		add_theme_support( 'block-template-parts' );
	}
}
