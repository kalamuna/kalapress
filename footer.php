<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KLPTheme
 */

?>

<div id="site-footer-container" class="">

	<footer class="site-footer ">

		<?php echo do_blocks( '<!-- wp:pattern {"slug":"kalapress/footer-default"} /-->' ); ?>

		<button class="scroll-to-top-button">
			<span class="screen-reader-text">
				<?php echo esc_html__( 'Scroll to the top of the page', KLP_TXT_DOMAIN ); ?>
			</span>
		</button>

	</footer>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
