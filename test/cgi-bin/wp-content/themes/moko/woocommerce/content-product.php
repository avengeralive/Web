<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

global $wp_query;
$data  = \MOKO\Includes\Classes\Common::instance()->data( 'single' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'full';
$sidebar = ( $sidebar ) ? $sidebar : 'product-sidebar';

if( !$layout || $layout == 'full' ) $classes[] = 'shop-item col-lg-3 col-md-6 col-sm-6 col-xs-12'; else $classes[] = 'shop-item col-lg-4 col-md-6 col-sm-6 col-xs-12'; ?>

<div <?php post_class( $classes ); ?> >
	<div class="inner-box">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */ ?>
		
		<div class="image">
			<?php woocommerce_template_loop_product_thumbnail(); ?>
			<div class="overlay-box">
				<ul class="cart-option">
					<li>
						<a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>">
							<span class="flaticon-shopping-cart-1"></span>
						</a>
						<span class="tooltip-data"><?php esc_html_e( 'Add to Cart', 'moko' ); ?></span>
					</li>
					<li>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						<a href="<?php echo esc_url($image[0]); ?>" data-fancybox="gallery-1" data-caption="<?php the_title_attribute(); ?>">
							<span class="fa fa-expand-arrows-alt"></span>
						</a>
						<span class="tooltip-data"><?php esc_html_e( 'Expand Image', 'moko' ); ?></span>
					</li>
				</ul>
			</div>
		</div>
		
		<?php do_action( 'woocommerce_before_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		//do_action( 'woocommerce_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
		
		<div class="lower-content">
			<div class="clearfix">
				<div class="pull-left">
					<h3><a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="pull-right">
					<!--Rating-->
					<div class="rating">
						<?php woocommerce_template_loop_rating(); ?>
					</div>
				</div>
			</div>
			<?php woocommerce_template_loop_price(); ?>
		</div>
		
		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
	</div>
</div>