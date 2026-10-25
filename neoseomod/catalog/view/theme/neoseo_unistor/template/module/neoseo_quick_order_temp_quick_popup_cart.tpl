<?php if($neoseo_quick_order_status && $neoseo_quick_order_status_popup_cart) { ?>
<div class="row">
    <div class="form-group col-sm-12 quick-cart" id="quick_order_block_popup_cart">
        <div class="input-group">
            <input type="hidden" id="cart_pop" name="cart_pop" value="<?php echo $products; ?>">
            <input type="text" id="input-phone-popup-cart" placeholder="<?php echo $text_quick_order; ?>" class="form-control"/>
                                            <span class="input-group-btn">
                                                <button id="button-quick-order-popup-cart" type="button" class="btn btn-default"  onclick="popupCart();">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span><?php echo $button_quick_order; ?></span>
                                                </button>
                                            </span>
        </div>
        <div class="help-block-popup-cart" style="display:none;font-weight:bold;"><?php echo $text_no_phone; ?></div>
        <style>
            .has-error #button-quick-order-popup-cart {
                border-bottom: 1px solid #a94442;
                border-top: 1px solid #a94442;
                border-right: 1px solid #a94442;
            }
        </style>
        <script><!--
            function doQuickOrderPopCart(){
                var phone = $('#input-phone-popup-cart').val();
                if( !phone ) {
                    $("#quick_order_block_popup_cart .help-block-popup-cart").show();
                    $("#quick_order_block_popup_cart").addClass("has-error");
                    $('#input-phone-popup-cart').height($('#button-quick-order-popup-cart').height()+3);
                    return;
                }
                $("#quick_order_block_popup_cart .help-block-popup-cart").hide();
                $("#quick_order_block_popup_cart").removeClass("has-error");
                $('#input-phone-popup-cart').height($('#button-quick-order-popup-cart').height()+1);

                var quantity = <?php echo isset($sum_quantity) ? $sum_quantity : 0; ?>;
                addQuickOrder('<?php echo $products; ?>', quantity, phone);
            }
            <?php if( $quick_order_phone_mask ) { ?>
                $("#input-phone-popup-cart").mask("<?php echo $quick_order_phone_mask; ?>");
            <?php } ?>
       --> </script>
    </div>
</div>
<?php }?>