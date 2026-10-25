<?php if($neoseo_quick_order_status && $neoseo_quick_order_status_cart) { ?>
<div class="row">
    <div class="form-group col-sm-4 pull-right" id="quick_order_block_cart">
        <div class="input-group">
            <input type="text" id="input-phone-cart" placeholder="<?php echo $text_quick_order; ?>" class="form-control"/>
                                            <span class="input-group-btn">
                                                <button id="button-quick-order-cart" type="button" class="btn btn-default"  onclick="doQuickOrder();">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span><?php echo $button_quick_order; ?></span>
                                                </button>
                                            </span>
        </div>
        <div class="help-block-cart" style="display:none;font-weight:bold;"><?php echo $text_no_phone; ?></div>
        <style>
            .has-error #button-quick-order {
                border-bottom: 1px solid #a94442;
                border-top: 1px solid #a94442;
                border-right: 1px solid #a94442;
            }
        </style>
        <script>
            function doQuickOrder(){
                var phone = $('#input-phone-cart').val();
                if( !phone ) {
                    $("#quick_order_block_cart .help-block-cart").show();
                    $("#quick_order_block_cart").addClass("has-error");
                    $('#input-phone-cart-cart').height($('#button-quick-order-cart').height()+3);
                    return;
                }
                $("#quick_order_block_cart .help-block-cart").hide();
                $("#quick_order_block_cart").removeClass("has-error");
                $('#input-phone-cart-cart').height($('#button-quick-order-cart').height()+1);

                var quantity = <?php echo isset($sum_quantity) ? $sum_quantity : 0; ?>;
                addQuickOrder('<?php echo $products;  ?>', quantity, phone);
            }
            <?php if( $quick_order_phone_mask ) { ?>
                $("#input-phone-cart").mask("<?php echo $quick_order_phone_mask; ?>");
            <?php } ?>
        </script>
    </div>
</div>
<?php }?>