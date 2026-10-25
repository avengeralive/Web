<? 
/* Template name: Checkout */
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
                    <div class="col-12 woocommerce">
                        <? if (stripos($_SERVER['REQUEST_URI'], 'order-received') === false) { ?>
                        <? $checkout = WC()->checkout();
                        do_action( 'woocommerce_before_checkout_form', $checkout );
                        if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	                        echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	                        return;
                        } ?>
                        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    	                <?php if ( $checkout->get_checkout_fields() ) : ?>
                        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                            <div class="col2-set" id="customer_details">
                                <div class="col-12 col-md-9">
                                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                                </div>
                                <div class="col-12">
                                    
                                </div>
                                <div class="col-12 col-md-9 shipping">
                                    <h3>Адрес доставки</h3>
                                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                                </div>
                            </div>

                            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                            <?php endif; ?>
	
                            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                            
                            <h3 id="order_review_heading"><?php esc_html_e( 'Доставка', 'woocommerce' ); ?></h3>
                            
                            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                            </div>

                            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

                        </form>

                        <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
                        <? } else { ?>
                        <p>Заказ принят!</p>
                        <p>В ближайшее время наши менеджеры обязательно с Вами свяжутся. При возникновении вопросов, просьба обращаться по телефону: +7 (499) 650-53-72. Время работы: с понедельника по пятницу 09:00-18:00. Благодарим за Ваш заказ!</p>
                        <? } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-xl-2"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>