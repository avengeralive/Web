<?php if($neoseo_quick_order_status && (isset($neoseo_quick_order_status_product) || isset($neoseo_quick_order_status_popup_cart) || isset($neoseo_quick_order_status_cart) || isset($neoseo_quick_order_status_popup_form) )) { ?>
<button type="button" class="quick_order btn btn-default btn-warning" id="button-quick-order" onclick="doQuickOrderPopCart();"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_quick_order; ?></span></button>

<script><!--
    function doQuickOrderPopCart(){

        showQuickOrder('<?php echo $products; ?>','');

    }
    --> </script>

<?php } ?>