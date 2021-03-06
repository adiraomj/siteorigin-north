<?php

function siteorigin_north_woocommerce_change_hooks(){
	// Move the price higher
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 4 );

	// Move the
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 35);

	// Use a custom upsell function to change number of items
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	add_action('woocommerce_after_single_product_summary', 'siteorigin_north_woocommerce_output_upsells', 15);

	// Remove actions in the cart
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
	remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
}
add_action('after_setup_theme', 'siteorigin_north_woocommerce_change_hooks');

function siteorigin_north_woocommerce_add_to_cart_text( $text ) {
	return $text;
}
add_filter('woocommerce_product_single_add_to_cart_text', 'siteorigin_north_woocommerce_add_to_cart_text');

function siteorigin_north_woocommerce_enqueue_styles( $styles ){
	$styles['northern-woocommerce'] = array(
		'src' => get_template_directory_uri() . '/woocommerce.css',
		'deps' => 'woocommerce-layout',
		'version' => SITEORIGIN_THEME_VERSION,
		'media' => 'all'
	);

	if( is_rtl() ) {
		$styles['northern-woocommerce-rtl'] = array(
			'src' => get_template_directory_uri() . '/woocommerce-rtl.css',
			'deps' => 'northern-woocommerce',
			'version' => SITEORIGIN_THEME_VERSION,
			'media' => 'all'
		);
		$styles['northern-woocommerce-smallscreen-rtl'] = array(
			'src' => get_template_directory_uri() . '/woocommerce-smallscreen-rtl.css',
			'deps' => 'northern-woocommerce',
			'version' => SITEORIGIN_THEME_VERSION,
			'media' => 'only screen and (max-width: ' . apply_filters( 'woocommerce_style_smallscreen_breakpoint', $breakpoint = '768px' ) . ')'
		);
	}

	if( function_exists('is_woocommerce') && is_woocommerce() && siteorigin_setting( 'responsive_disabled' ) ) {
		unset( $styles['woocommerce-smallscreen'] );
		unset( $styles['northern-woocommerce-smallscreen-rtl'] );
	}

	return $styles;
}
add_filter('woocommerce_enqueue_styles', 'siteorigin_north_woocommerce_enqueue_styles');

function siteorigin_north_woocommerce_enqueue_scripts( ){
	if( !function_exists('is_woocommerce') ) return;

	if( is_woocommerce() ) {
		wp_enqueue_script( 'siteorigin-north-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
	}
}
add_filter('wp_enqueue_scripts', 'siteorigin_north_woocommerce_enqueue_scripts');

function siteorigin_north_woocommerce_loop_shop_columns(){
	return 3;
}
add_filter('loop_shop_columns', 'siteorigin_north_woocommerce_loop_shop_columns');

function siteorigin_north_woocommerce_related_product_args( $args ) {
	$args['columns'] = 3;
	$args['posts_per_page'] = 3;
	return $args;
}
add_filter('woocommerce_output_related_products_args', 'siteorigin_north_woocommerce_related_product_args');

if( !function_exists('siteorigin_north_woocommerce_output_upsells') ) {

	function siteorigin_north_woocommerce_output_upsells(){
		woocommerce_upsell_display( -1, 3 );
	}

}

if( !function_exists('siteorigin_north_woocommerce_template_single_undertitle_meta') ) {

	function siteorigin_north_woocommerce_template_single_undertitle_meta(){
		wc_get_template( 'single-product/meta-undertitle.php' );
	}

}
add_action('woocommerce_single_product_summary', 'siteorigin_north_woocommerce_template_single_undertitle_meta', 7);

if( !function_exists('siteorigin_north_woocommerce_update_cart_count') ) {

	function siteorigin_north_woocommerce_update_cart_count( $fragments ) {
		ob_start();
		?>
		<span class="shopping-cart-count"><?php echo WC()->cart->cart_contents_count;?></span>
		<?php

		$fragments['span.shopping-cart-count'] = ob_get_clean();

		return $fragments;
	}

}
add_filter('add_to_cart_fragments', 'siteorigin_north_woocommerce_update_cart_count');

/*
* Enabling breadcrumbs in product pages and archives.
*/
add_action('woocommerce_single_product_summary','siteorigin_north_breadcrumbs', 6, 0);
add_action('woocommerce_before_shop_loop','siteorigin_north_breadcrumbs', 6, 0);
