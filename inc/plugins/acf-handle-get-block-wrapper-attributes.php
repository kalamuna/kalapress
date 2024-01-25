<?php

namespace KLPTheme;

if ( ! function_exists( 'acf_handle_get_block_wrapper_attributes' ) ) {

	/**
	 * Get the attributes for the block wrapper.
	 *
	 * @param array $block The block.
	 * @param bool  $is_preview Whether the block is being previewed.
	 * @param array $extra_attrs Extra attributes to add to the wrapper.
	 *
	 * @see https://www.advancedcustomfields.com/resources/acf-blocks-using-get_block_wrapper_attributes/
	 * @see https://gist.github.com/joseph-farruggio/2c4e7e427625c69783da6fc461969a9a
	 *
	 * @return string
	 */
	function acf_handle_get_block_wrapper_attributes( $block, $is_preview, $extra_attrs = [] ) {
		$attrs = array();

		foreach ( $extra_attrs as $key => $value ) {
			if ( $key === 'class' || $key === 'id' || strpos( $key, 'data-' ) === 0 ) {
				$attrs[ $key ] = $value;
			}
		}

		// In preview mode, manually construct the attribute string
		if ( $is_preview ) {
			if ( isset( $block['className'] ) ) {
				$attrs['class'] .= ' ' . $block['className'];
			}
			if ( ! empty( $block['align'] ) ) {
				$attrs['class'] .= ' align' . $block['align'];
			}
			$attrs['class'] = trim( $attrs['class'] );

			return stringify_html_attributes( $attrs );
		} else {
			// Let WordPress handle the attribute string in the front-end
			return get_block_wrapper_attributes( $extra_attrs );
		}
	}
}

/**
 * Unwrap HTML attributes from an array into a string.
 *
 * @param array $attrs Array of attributes.
 * @return string
 */
function stringify_html_attributes( $attrs ) {
	$attributes = '';

	foreach ( $attrs as $key => $value ) {
		if ( is_bool( $value ) && $value ) {
			// For boolean attributes, just add the attribute name (e.g., "disabled")
			$attributes .= ' ' . $key;
		} else {
			// For other attributes, add key="value"
			$attributes .= sprintf( ' %s="%s"', $key, esc_attr( $value ) );
		}
	}

	return $attributes;
}
