<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Native Dyn – hello from a dynamic block!', 'native' ); ?>
	<!-- querying the pages and show them here for test -->
	<ul>
		<?php
		$pages = get_pages();
		foreach ( $pages as $page ) {
			?>
			<li>
				<a href="<?php echo get_permalink( $page->ID ); ?>">
					<?php echo $page->post_title; ?>
				</a>
			</li>
			<?php
		}
		?>
	</ul>
</div>