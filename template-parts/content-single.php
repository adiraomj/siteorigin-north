<?php
/**
 * Template part for displaying single posts.
 *
 * @package siteorigin-north
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<?php if( has_post_thumbnail() && siteorigin_setting('blog_featured_single') ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail() ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php siteorigin_north_breadcrumbs(); ?>

		<div class="entry-meta">
			<?php siteorigin_north_post_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'siteorigin-north' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php siteorigin_north_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

