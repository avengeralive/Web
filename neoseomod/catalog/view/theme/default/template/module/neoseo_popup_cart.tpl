<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></button>
                <h3 class="modal-title"><?php echo $text_popup_cart_title; ?></h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <!-- NeoSeo QuickOrder - begin -->
                <?php if(isset($quickorder_code)) echo $quickorder_code; ?>
                <!-- NeoSeo QuickOrder - end -->
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button_continue; ?></button>
                <a href="<?php echo $button_checkout_url; ?>" class="btn btn-primary"><?php echo $button_checkout; ?></a>
            </div>
        </div>
    </div>
</div>
