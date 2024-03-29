<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kalapress
 */

use function KLPTheme\display_entry_footer;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="single-post__article">
	<div
		class="entry-content<?php echo 'post' === get_post_type() ? ' single-post__content page-layout--narrow' : ''; ?>">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

	<footer
		class="entry-footer single-post__footer <?php echo 'post' === get_post_type() ? ' page-layout--narrow' : ''; ?>">
		<?php display_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
