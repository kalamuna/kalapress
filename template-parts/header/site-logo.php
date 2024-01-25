<?php

if ( ! function_exists( '\\get_field' ) ) {
	return;
}

$logo = \get_field( 'header_logo_desktop', 'option' );
$logo_snapped = \get_field( 'header_logo_snapped', 'option' ) ?: $logo;
?>

<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-link">
	<div class="site-header__logo">
		<?php
		// Display desktop logo
		if ( is_array( $logo ) && isset( $logo['url'] ) ) {
			$alt_text = isset( $logo['alt'] ) ? esc_attr( $logo['alt'] ) : '';
			echo '<img src="' . esc_url( $logo['url'] ) . '" alt="' . $alt_text . '" class="site-header__logo-image">';
		}
		// Display snapped logo
		if ( is_array( $logo_snapped ) && isset( $logo_snapped['url'] ) ) {
			$alt_text_snapped = isset( $logo_snapped['alt'] ) ? esc_attr( $logo_snapped['alt'] ) : '';
			echo '<img src="' . esc_url( $logo_snapped['url'] ) . '" alt="' . $alt_text_snapped . '" class="site-header__logo-image--small">';
		}
		?>
		<span class="screen-reader-text">
			<?php bloginfo( 'name' ); ?>
		</span>
	</div>
</a>
