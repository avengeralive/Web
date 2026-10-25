<? 
/* Template name: Cart */
get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-1 col-xl-2"></div>
            <div class="col-md-12 col-lg-10 col-xl-8 text-center page-header">
                <h1><? the_title(); ?></h1>
            </div>
            <div class="col-lg-1 col-xl-2"></div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-xl-2"></div>
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="row">
                    <div class="col-12">
                        <? do_action( 'woocommerce_before_cart' ); ?>
                        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                            <?php do_action( 'woocommerce_before_cart_table' ); ?>
                            <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { 
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                ?>
                                <div class="row woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                                    <div class="col-4 col-md-2">
                                        <img src="<?=get_the_post_thumbnail_url($product_id, 'thumbnail');?>" class="cart_image">
                                    </div>
                                    <div class="col-8 col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2>
                                                <?php
                                                    if ( ! $product_permalink ) {
                                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                                    } else {
                                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                    }

                                                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                    // Meta data.
                                                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                                    // Backorder notification.
                                                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                    }
                                                ?>
                                                </h2>
                                                <p class="sku">Арт. <?=$_product->get_sku();?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                ?>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="quantity">
                                                    <a class="chqty mn" data-change="quantity_<?=$cart_item_key;?>"><i class="fas fa-minus"></i></a>
                                                    <input type="number" id="quantity_<?=$cart_item_key;?>" class="input-text qty text" step="1" min="0" max="" name="cart[<?=$cart_item_key;?>][qty]" value="<?=$cart_item['quantity'];?>" title="Кол-во" size="2" placeholder="" inputmode="numeric">
                                                    <a class="chqty pl" data-change="quantity_<?=$cart_item_key;?>"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="favs"><a href="" class="fav-out"><i class="far fa-heart"></i> В избранное</a><a href="" class="fav-in"><i class="fas fa-heart"></i> В избранном</a> <a href="<?=wc_get_cart_remove_url( $cart_item_key )?>" class="delete"><img src="<?=get_template_directory_uri();?>/images/trash.svg"> Удалить</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <? }
                            } ?>
                                <div class="row cart-footer">
                                    <div class="col-md-9 actions">

                                        <?php if ( wc_coupons_enabled() ) { ?>
                                            <div class="coupon">
                                                <label for="coupon_code"><?php esc_html_e( 'Промокод:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Промокод', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
                                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                            </div>
                                        <?php } ?>

                                        <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                                        <?php do_action( 'woocommerce_cart_actions' ); ?>

                                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="cart-collaterals">
                                            <?php do_action( 'woocommerce_cart_collaterals' ); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                            </div>
                            <?php do_action( 'woocommerce_after_cart_table' ); ?>
                        </form>
                        <?php do_action( 'woocommerce_after_cart' ); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-xl-2"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>