<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package siteorigin-north
 * @license GPL 2.0
 */

?>

		</div><!-- .container -->
	</div><!-- #content -->

	<?php do_action( 'siteorigin_north_footer_before' ); ?>

	<footer id="colophon" class="site-footer <?php if ( ! siteorigin_setting( 'footer_constrained' ) ) echo 'unconstrained-footer' ?>" role="contentinfo">

		<?php do_action( 'siteorigin_north_footer_top' ); ?>

		<?php if ( ! siteorigin_page_setting( 'hide_footer_widgets', false ) && ! in_array( siteorigin_page_setting( 'layout' ), array( 'stripped' ), true ) ) : ?>
			<div class="container">

				<?php $siteorigin_north_sidebars = wp_get_sidebars_widgets(); ?>
				<?php if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) : ?>
					<?php if ( is_active_sidebar( 'wc-footer' ) ) : ?>
						<div class="widgets widget-area widgets-<?php echo count( $siteorigin_north_sidebars['wc-footer'] ) ?>" role="complementary" aria-label="<?php _e( 'WC Footer', 'siteorigin-north' ); ?>">
							<?php dynamic_sidebar( 'wc-footer' ); ?>
						</div>
					<?php endif; ?>
				<?php elseif ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
					<div class="widgets widget-area widgets-<?php echo count( $siteorigin_north_sidebars['footer-sidebar'] ) ?>" role="complementary" aria-label="<?php _e( 'Footer Sidebar', 'siteorigin-north' ); ?>">
						<?php dynamic_sidebar( 'footer-sidebar' ); ?>
					</div>
				<?php endif; ?>

			</div><!-- .container -->
		<?php endif; ?>

		<div class="site-info">
			<div class="container">
				<?php
				siteorigin_north_footer_text();

				$credit_text = apply_filters(
					'siteorigin_north_footer_credits',
					sprintf( esc_html__( 'Theme by %s.', 'siteorigin-north' ), '<a href="https://siteorigin.com/" rel="designer">SiteOrigin</a>' )
				);

				if ( ! empty( $credit_text ) ) {
					?><span class="sep"> | </span><?php
					echo wp_kses_post( $credit_text );
				}
				?>
			</div>
		</div><!-- .site-info -->

		<?php do_action( 'siteorigin_north_footer_bottom' ); ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( siteorigin_setting( 'navigation_scroll_to_top' ) && siteorigin_page_setting( 'layout' ) !== 'stripped' ) : ?>
	<div id="scroll-to-top">
		<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'siteorigin-north' ); ?></span>
		<?php siteorigin_north_display_icon( 'up-arrow' ); ?>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
