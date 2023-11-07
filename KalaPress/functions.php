<?php
/**
 * KalaPress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KLPTheme
 */

namespace KLPTheme;

/**
 * Defining constants used across the theme.
 *
 */
defined( 'KLP_NAME' ) || define( 'KLP_NAME', 'KalaPress' );
defined( 'KLP_SLUG' ) || define( 'KLP_SLUG', 'kalapress' );
defined( 'KLP_VER' ) || define( 'KLP_VER', '1.0.0' );
defined( 'KLP_TXT_DOMAIN' ) || define( 'KLP_TXT_DOMAIN', 'kalapress' );
defined( 'KLP_URI' ) || define( 'KLP_URI', rtrim( get_stylesheet_directory_uri(), '/' ) );
defined( 'KLP_DIR' ) || define( 'KLP_DIR', rtrim( get_stylesheet_directory(), '/' ) );
defined( 'KLP_INC_DIR' ) || define( 'KLP_INC_DIR', rtrim( get_stylesheet_directory() . '/inc', '/' ) );

/**
 * Returns the fully qualified name of the function.
 * This is used instead of __NAMESPACE__ . '\\' . $function
 *
 * mostly used in add_action and add_filter like
 * @example <code>
 * add_action( 'init', space( 'kalapress_register_block_styles' ) );
 * </code>
 *
 * @param string $function
 * @return string
 *
 */
function space( $function ) {
	return __NAMESPACE__ . "\\$function";
}


/**
 * Autoload all of the classes.
 */
require_once dirname( __FILE__ ) . '/vendor/autoload.php';

/**
 * Instantiate main Theme class
 */
$theme = new Core\Theme();


/**
 * Load theme options.
 */
include_once get_template_directory() . '/theme-options.php';

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function kalapress_register_block_styles() {

	$block_styles = array(
		'core/list' => array(
			'checkmark' => __( 'Checkmark', 'kalapress' ),
			'no-disc' => __( 'No disc', 'kalapress' )
		),
		'core/button' => array(
			'alternate' => __( 'Alternate', 'kalapress' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name' => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', space( 'kalapress_register_block_styles' ) );

/**
 * Create a custom menu.
 *
 * To use, set the $theme_location to your menu location.
 * ie. create_custom_menu("primary")
 */
function create_custom_menu( $theme_location ) {
	if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {
		$menu = get_term( $locations[ $theme_location ], 'nav_menu' );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );
		$menu_list = '<ul class="menu menu--' . $theme_location . '">';
		$count = 1;
		$bool = true;

		foreach ( $menu_items as $menu_item ) {
			$current = ( $menu_item->object_id == get_queried_object_id() ) ? 'menu__item--current' : '';
			$menu_icon = get_field( 'icon', $menu_item );
			$icon = ( $menu_icon == null ) ? '' : '<img class="menu__item__icon" src="' . $menu_icon . '" alt="" />';

			if ( $menu_item->menu_item_parent == 0 ) {
				$parent = $menu_item->ID;
				$menu_target = ( $menu_item->target == null ) ? '' : 'target="' . $menu_item->target . '"';
				$classes = ! empty( $menu_item->classes ) ? $menu_item->classes : "";

				$menu_classes = implode( '', $classes );

				$menu_array = array();
				foreach ( $menu_items as $sub_menu ) {
					if ( $sub_menu->menu_item_parent == $parent ) {
						$bool = true;
						$parents = $sub_menu->ID;
						$sub_menu_target = ( $sub_menu->target == null ) ? '' : 'target="' . $sub_menu->target . '"';

						$sub_menu_icon = get_field( 'icon', $sub_menu );
						$sub_menu_icon_image = ( $sub_menu_icon == null ) ? '' : '<img class="menu__item__icon" src="' . $sub_menu_icon . '" alt="" />';

						$menu_array[] = '<li><a href="' . $sub_menu->url . '"' . $sub_menu_target . '>' . $sub_menu_icon_image . $sub_menu->title . '</a></li>' . "\n";
					}
				}

				// If a menu item has children, add a details element for the submenu.
				if ( $bool == true && count( $menu_array ) > 0 ) {


					$menu_list .= '<li class="menu__item menu__item--parent ' . $current . $menu_classes . '">' . "\n";
					$menu_list .= '<a href="' . $menu_item->url . '"' . $menu_target . '>' . $icon . $menu_item->title . '</a>' . "\n";

					$menu_list .= '<details><summary><span class="screen-reader-text">Toggle submenu</span></summary>' . "\n";
					$menu_list .= '<ul class="menu__sub-menu">' . "\n";
					$menu_list .= implode( "\n", $menu_array );
					$menu_list .= '</ul>';
					$menu_list .= '</details>';
				}


				// Otherwise display a single list item and menu link.
				else {
					$menu_list .= '<li class="menu__item ' . $current . '' . $menu_classes . '">' . "\n";
					$menu_list .= '<a href="' . $menu_item->url . '" ' . $menu_target . '>' . $icon . $menu_item->title . '</a>' . "\n";
				}
			} // end
			$menu_list .= '</li>';
			$count++;
		}

		$menu_list .= '</ul>';

	} else {
		$menu_list = '<!-- There is no menu defined. "' . $theme_location . '" -->';
	}
	echo $menu_list;
}

/* Append the ACF menu icon to WordPres menus too. */
add_filter( 'wp_nav_menu_objects', space( 'kalapress_wp_nav_menu_objects' ), 10, 2 );
function kalapress_wp_nav_menu_objects( $items, $args ) {
	foreach ( $items as &$item ) {
		$icon = get_field( 'icon', $item );

		if ( $icon ) {
			$item->title = '<img class="menu__item__icon" src="' . $icon . '" alt="" />' . $item->title;
		}
	}
	return $items;
}

// @TODO: This dangles here since we do not have a seperate clean place to put the fucntions.
// once the classes and clean up is done, this should be moved to a better place.
// MAYBE, for this project, this is fine. But cleaning must be done in kalapress.
/**
 * Removes the extra classes from the span tag
 * that is added by the screen reader format toolbar.
 * This is related to src/js/editor/format-toolbar-screen-reader-text.js
 *
 * @param string $block_content Block HTML content.
 * @param array  $block         Block data.
 *
 * @return string
 */
function kalapress_remove_extra_classes_from_screen_reader_text( $block_content, $block ) {
	if ( ! $block_content || $block['blockName'] !== 'core/paragraph' ) {
		return $block_content;
	}

	// Initialize the tag processor. (Added in WordPress 6.2 yay! 👏)
	$processor = new \WP_HTML_Tag_Processor( $block_content );

	while ( $processor->next_tag( 'span' ) ) {
		$current_classes = $processor->get_attribute( 'class' ) ?? '';

		if ( strpos( $current_classes, 'screen-reader-text-fe' ) !== false ) {
			$classes = explode( ' ', $current_classes );

			$classes = array_diff( $classes, array( 'dashicons-before', 'dashicons-universal-access-alt' ) );
			$processor->set_attribute( 'class', implode( ' ', $classes ) );
			break;
		}
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block', space( 'kalapress_remove_extra_classes_from_screen_reader_text' ), 10, 2 );
