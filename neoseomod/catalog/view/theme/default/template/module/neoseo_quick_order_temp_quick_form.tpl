<?php if($neoseo_quick_order_status && $neoseo_quick_order_status_product) { ?>
<div class="row">
    <div class="form-group col-sm-12" id="quick_order_block">
        <div class="input-group">
            <input type="text" id="input-phone" placeholder="<?php echo $text_quick_order; ?>" class="form-control"/>
                                            <span class="input-group-btn">
                                                <button id="button-quick-order" type="button" class="btn btn-default"  onclick="doQuickOrder();">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span><?php echo $button_quick_order; ?></span>
                                                </button>
                                            </span>
        </div>
        <div class="help-block" style="display:none;font-weight:bold;"><?php echo $text_no_phone; ?></div>
        <style>
            .has-error #button-quick-order {
                border-bottom: 1px solid #a94442;
                border-top: 1px solid #a94442;
                border-right: 1px solid #a94442;
            }
        </style>
        <script>
            function doQuickOrder(){
                var phone = $('#input-phone').val();
                if( !phone ) {
                    $("#quick_order_block .help-block").show();
                    $("#quick_order_block").addClass("has-error");
                    $('#input-phone').height($('#button-quick-order').height()+3);
                    return;
                }
                $("#quick_order_block .help-block").hide();
                $("#quick_order_block").removeClass("has-error");
                $('#input-phone').height($('#button-quick-order').height()+1);

                var quantity = $('#input-quantity').val();
                addQuickOrder($("input[name='product_id']" ).val(), quantity, phone);
            }
            <?php if( $quick_order_phone_mask ) { ?>
                $("#input-phone").mask("<?php echo $quick_order_phone_mask; ?>");
            <?php } ?>
        </script>
    </div>
</div>
<?php } ?>