<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;?>

<?php do_action( 'woocommerce_before_cart_contents' ); ?>
<?php if(  WC()->cart->get_cart() ):
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
	$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
?>

<div class="cart-product">
	<div class="inner">
		<div class="cross-icon"><span class="icon fa fa-remove"></span></div>
		<div class="image">
			<?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				if ( ! $_product->is_visible() )
					echo esc_attr($thumbnail);
				else
					printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
			?>
		</div>
		<h3>
			<?php if ( ! $_product->is_visible() )
				echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
			else
				echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
			?>
		</h3>
		<div class="quantity-text"><?php esc_html_e('Quantity', 'moko'); ?> <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'moko'), $woocommerce->cart->cart_contents_count); ?></div>
		<div class="price"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></div>
	</div>
</div>

<?php
	}
}
else: ?>
<div class="cart-product">
	<p class="center-align"><?php esc_html_e( 'There is no item in your cart',  'moko' ); ?></p>
</div>
<?php endif;?>