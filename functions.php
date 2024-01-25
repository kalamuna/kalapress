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
$autoload_path = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( ! file_exists( $autoload_path ) ) {
	require_once KLP_DIR . '/Core/Util/Logger.php';

	Core\Util\Logger::logAndNotice(
		'Error: Urgent developer action required: Composer autoloader not found. Please run composer install in the theme directory.',
		'error'
	);

	return;
}
// If the autoloader file exists, require it and continue as normal.
require_once $autoload_path;

/**
 * Instantiate main Theme class
 * This is the entry point for the theme.
 * All of the classes are instantiated inside the Theme class.
 * The Container class is used to manage the dependency injection.
 *
 * @see Core/Theme.php
 */
$theme = new Core\Theme();

/**
 * Load theme options.
 */
include_once get_template_directory() . '/theme-options.php';

/**
 ************* @TODO: The below parts will be removed/moved to proper files *************
 *
 */


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
