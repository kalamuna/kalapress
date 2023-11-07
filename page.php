<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kalapress
 */

namespace KLPTheme;

?>

<?php
get_header();
?>

<main id="main-content">

	<?php
	get_template_part( 'template-parts/hero' );
	?>

	<div class="page-layout">
		<div class="page-layout--full">
			<?php
			get_template_part( 'template-parts/content', get_post_type() );
			?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
