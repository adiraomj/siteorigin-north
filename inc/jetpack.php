<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package siteorigin-north
 */

if ( ! function_exists( 'siteorigin_north_jetpack_setup' ) ) :
/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function siteorigin_north_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'siteorigin_north_infinite_scroll_render',
		'footer'    => 'page',
		'posts_per_page' => 9,
	) );
} // end function siteorigin_north_jetpack_setup
endif;
add_action( 'after_setup_theme', 'siteorigin_north_jetpack_setup' );

if ( ! function_exists( 'siteorigin_north_infinite_scroll_render' ) ) :
/**
 * Custom render function for Infinite Scroll.
 */
function siteorigin_north_infinite_scroll_render() {
	if ( function_exists( 'is_woocommerce' ) && ( is_shop() || is_woocommerce() ) ) {
		echo '<ul class="products">';
		while ( have_posts() ) {
			the_post();
			wc_get_template_part( 'content', 'product' );
		}
		echo '</ul>';
	} else {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		}
	}
} // end function siteorigin_north_infinite_scroll_render
endif;
