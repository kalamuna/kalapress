<?php

/**
 * Template Name: Page with Sidebar
 *
 */

get_header();
?>


<main id="main-content">
	<?php
	get_template_part( 'template-parts/hero' );
	?>

	<div class="page-layout">
		<div class="page-layout--left">
			<?php
			get_template_part( 'template-parts/content', get_post_type() );
			?>
		</div>
		<div class="page-layout--sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php
get_footer();
