<?php

namespace KLPTheme;

/**
 * Creates a custom menu.
 *
 * To use, set the $theme_location to your menu location.
 * ie. echo get_display_custom_menu("primary");
 * don't forget to echo it.
 *
 * @param string $theme_location The menu location to display.
 * @return string HTML of the menu.
 */
function get_display_custom_menu( $theme_location ) {
	if ( empty( $theme_location ) || ! ( $locations = get_nav_menu_locations() ) || ! isset( $locations[ $theme_location ] ) ) {
		return '<!-- ' . sprintf( __( 'There is no menu defined for %s.', KLP_TXT_DOMAIN ), $theme_location ) . ' -->';
	}

	$menu = get_term( $locations[ $theme_location ], 'nav_menu' );
	$menu_items = wp_get_nav_menu_items( $menu->term_id );
	if ( empty( $menu_items ) ) {
		return '<!-- ' . sprintf( __( 'No items in %s menu.', KLP_TXT_DOMAIN ), $theme_location ) . ' -->';
	}

	$menu_list = '<ul class="menu menu--' . esc_attr( $theme_location ) . '">';
	foreach ( $menu_items as $menu_item ) {
		if ( $menu_item->menu_item_parent != 0 ) {
			continue;
		}

		$current = ( $menu_item->object_id == get_queried_object_id() ) ? ' menu__item--current' : '';
		$icon = '';

		if ( function_exists( '\\get_field' ) ) {
			$menu_icon = \get_field( 'menu_item_icon', $menu_item );
			$icon = $menu_icon ? '<img class="menu__item__icon" src="' . esc_url( $menu_icon ) . '" alt="" />' : '';
		}

		$menu_list .= '<li class="menu__item menu__item--parent' . $current . '">' . "\n";
		$menu_list .= '<a href="' . esc_url( $menu_item->url ) . '" target="' . esc_attr( $menu_item->target ) . '">' . $icon . esc_html( $menu_item->title ) . '</a>' . "\n";

		$submenu = array_filter( $menu_items, function ($item) use ($menu_item) {
			return $item->menu_item_parent == $menu_item->ID;
		} );

		if ( ! empty( $submenu ) ) {
			$menu_list .= '<details><summary><span class="screen-reader-text">' . __( 'Toggle submenu', KLP_TXT_DOMAIN ) . '</span></summary>' . "\n";
			$menu_list .= '<ul class="menu__sub-menu">' . "\n";

			foreach ( $submenu as $sub_menu ) {
				$sub_menu_icon_img = '';
				if ( function_exists( '\\get_field' ) ) {
					$sub_menu_icon = \get_field( 'menu_item_icon', $sub_menu );
					$sub_menu_icon_img = $sub_menu_icon ? '<img class="menu__item__icon" src="' . esc_url( $sub_menu_icon ) . '" alt="" />' : '';
				}

				$menu_list .= '<li><a href="' . esc_url( $sub_menu->url ) . '" target="' . esc_attr( $sub_menu->target ) . '">' . $sub_menu_icon_img . esc_html( $sub_menu->title ) . '</a></li>' . "\n";
			}

			$menu_list .= '</ul>';
			$menu_list .= '</details>';
		}

		$menu_list .= '</li>';
	}

	$menu_list .= '</ul>';

	return $menu_list; // returning the HTML menu. so to use it, just echo the function, and don't just call it in the template.
}
