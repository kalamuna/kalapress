<?php

namespace KLPTheme\Core\Util;

class Logger {

	/**
	 * @var bool Tracks if styles have been added to prevent duplicate output.
	 */
	private static $stylesAdded = false;

	/**
	 * Adds a message to the WordPress admin notices queue.
	 *
	 * @param string $message The message content.
	 * @param string $type The type of notice. Default 'info'.
	 * @return void
	 * @uses add_action()
	 * @TODO: Make use of https://make.wordpress.org/core/2023/10/16/introducing-admin-notice-functions-in-wordpress-6-4/ once rolled out.
	 * currently we are at 6.3.2, so, soon my friend, soon. We will be able to use this across the theme:
	 * wp_get_admin_notice(), and wp_admin_notice()
	 */
	public static function adminNotice( $message, $type = 'info' ) {
		add_action( 'admin_notices', function () use ($message, $type) {
			echo self::generateNotice( $message, $type );
		} );
	}

	/**
	 * Logs a message to the WordPress debug log.
	 *
	 * @param string $message The message content.
	 * @uses WP_DEBUG_LOG
	 * @uses error_log()
	 * @return void
	 */
	public static function log( $message ) {
		if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
			error_log( $message );
		}
	}

	/**
	 * Logs a message to the WordPress debug log and adds a message to the WordPress admin notices queue.
	 *
	 * @param string $message The message content.
	 * @param string $type The type of notice. Default 'info'.
	 * @return void
	 * @uses self::log()
	 * @uses self::adminNotice()
	 */
	public static function logAndNotice( $message, $type = 'info' ) {
		self::log( $message );
		self::adminNotice( $message, $type );
	}

	/**
	 * Logs an exception to the WordPress debug log and adds a message to the WordPress admin notices queue.
	 *
	 * @param \Exception $exception The exception object.
	 * @param bool $displayNotice Whether to display the notice in the WordPress admin. Default false.
	 * @return void
	 * @uses self::log()
	 * @uses self::adminNotice()
	 */
	public static function handleException( \Exception $exception, $displayNotice = false ) {
		self::log( $exception->getMessage() );

		if ( $displayNotice ) {
			self::adminNotice( $exception->getMessage(), 'error' );
		}
	}

	/**
	 * Determines if a notice type is dismissible.
	 *
	 * @param string $type The notice type.
	 * @return bool Whether the notice type is dismissible.
	 */
	private static function isDismissible( $type ) {
		$nonDismissibleTypes = [ 'error' ];
		return ! in_array( $type, $nonDismissibleTypes );
	}

	/**
	 * Generates the HTML markup for an admin notice.
	 *
	 * @param string $message The message content.
	 * @param string $type The type of notice. Default 'info'.
	 * @uses esc_html__()
	 * @return string The notice HTML.
	 */
	private static function generateNotice( $message, $type ) {
		$icon            = self::generateIcon( $type );
		$isDismissible   = self::isDismissible( $type ) ? 'is-dismissible' : '';
		$escaped_message = esc_html__( $message, KLP_TXT_DOMAIN );

		$notice = self::generateStyleTag();
		$notice .= "<div class='notice kwp-notice $type $isDismissible'>";
		$notice .= "<div class='kwp-notice__icon-wrap'>$icon</div>";
		$notice .= "<p class='kwp-notice__message'>{$escaped_message}</p>";
		$notice .= '</div>';

		return $notice;
	}

	/**
	 * Generates an icon for a notice.
	 *
	 * @param string $type The type of notice.
	 * @return string The icon HTML.
	 */
	private static function generateIcon( $type ) {
		$icons = [
			'error'   => '<svg aria-hidden="true" class="kwp-notice__icon" viewBox="0 0 24 24"><path class="icon-bg" d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm5 9H7v-2h10v2z" /><path class="icon-stroke" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5-9h10v2H7z" /></svg>',
			'success' => '<svg aria-hidden="true" class="kwp-notice__icon" viewBox="0 0 24 24"><path class="icon-bg" d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm-2 13l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/><path class="icon-stroke" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4 8-8z" /></svg>',
			'warning' => '<svg aria-hidden="true" class="kwp-notice__icon" viewBox="0 0 24 24"><path class="icon-bg" d="M4.47 19h15.06L12 5.99 4.47 19zM13 18h-2v-2h2v2zm0-4h-2v-4h2v4z"/><path class="icon-stroke" d="M1 21h22L12 2 1 21zm3.47-2L12 5.99 19.53 19H4.47zM11 16h2v2h-2zm0-6h2v4h-2z" /></svg>',
			'info'    => '<svg aria-hidden="true" class="kwp-notice__icon" viewBox="0 0 24 24"><path class="icon-bg" d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1 13h-2v-6h2v6zm0-8h-2V7h2v2z" /><path class="icon-stroke" d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>'
		];

		return isset( $icons[ $type ] ) ? $icons[ $type ] : $icons['info'];
	}

	/**
	 * Generates the styles for the admin notices.
	 * This is added only once to prevent duplicate output.
	 * The styles are added inline to avoid having to load a separate CSS file.
	 * This can be argued against, but I think it's fine for this use case.
	 *
	 * @return string The styles HTML.
	 */
	private static function generateStyleTag() {
		if ( self::$stylesAdded ) {
			return '';
		}

		self::$stylesAdded = true;

		return '
            <style>.kwp-notice {--bg-clr: #F9FAFB;--border-clr: #D2D5DB;--text-clr: #202937;--ico-clr: #000000;--ico-dimensions: 32px;display: flex;align-items: center;background-color: var(--bg-clr) !important;color: var(--text-clr) !important;min-height: 65px !important;padding: 10px;border-radius: 6px;border: 1px solid var(--border-clr) !important;border-left-width: 4px !important;}.kwp-notice__message {font-size: 1rem;}.kwp-notice__icon-wrap {display: inline-flex;margin-right: 10px;}.kwp-notice__icon {fill: var(--ico-clr);width: var(--ico-dimensions);height: var(--ico-dimensions);}.kwp-notice__icon .icon-bg {opacity: 0.2 !important;}.kwp-notice.error {--bg-clr: #FDF2F2;--border-clr: #9B1C1B;--text-clr: #9B1C1B;--ico-clr: #9B1C1B;}.kwp-notice.warning {--bg-clr: #FDFDEA;--border-clr: #FACA16;--text-clr: #723B13;--ico-clr: #723B13;}.kwp-notice.success {--bg-clr: #F3FAF7;--border-clr: #84E1BC;--text-clr: #05543F;--ico-clr: #05543F;}.kwp-notice.info {--bg-clr: #ECF5FF;--border-clr: #A5CAFD;--text-clr: #1D429F;--ico-clr: #1D429F;}
            </style>
        ';
	}
}
