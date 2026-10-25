<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<!--Start single sidebar-->
<div class="search-box">
	<form class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
		<div class="form-group">
			<input type="hidden" name="post_type[]" value="product">
			<input type="text" name="s" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Enter Keyword', 'moko' ); ?>" class="search-field" />
			<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
		</div>
	</form>
</div>