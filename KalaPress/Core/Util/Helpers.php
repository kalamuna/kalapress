<?php
/**
 * Helpers Class File
 * Contains helper methods that can be used throughout the theme.
 *
 * @package    KLPTheme
 */

namespace KLPTheme\Core\Util;

/**
 * Helpers
 *
 * This class contains helper methods that can be used throughout the theme.
 * All methods must be static and can be called directly.
 *
 * @package KLPTheme
 */
class Helpers {
	private function __construct() {
		// Made private and intentionally left empty, no instantiation allowed,
		// since all methods must be static.
	}

	/**
	 * Gets the youtube ID from a youtube URL.
	 *
	 * @param string $url The youtube URL.
	 * @see https://stackoverflow.com/a/17030234/13507727
	 * @return string
	 */
	public static function get_youtube_id_from_url( $url ) {
		$pattern = '#^(?:https?://|//)?(?:www\.|m\.)?(?:youtu\.be/|youtube\.com/(?:embed/|v/|watch\?v=|watch\?.+&v=))([\w-]{11})(?![\w-])#';
		preg_match( $pattern, $url, $matches );
		return ( isset( $matches[1] ) ) ? $matches[1] : false;
	}
}
