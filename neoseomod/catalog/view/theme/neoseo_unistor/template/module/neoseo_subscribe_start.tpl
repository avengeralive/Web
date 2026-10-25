<div class="module">
    <div class="row">
        <div class="subscribe box-shadow box-corner">
            <div class="subscribe-title"><?php echo $text_title; ?></div>
            <?php if ($show_name) { ?>
            <input type="text" id="subscribe-name" name="subscribe_name<?php echo $module; ?>" placeholder="<?php echo $text_name; ?>">
            <?php } ?>
            <div class="subscribe-group">
                <input type="text" id="subscribe<?php echo $module; ?>" name="subscribe" placeholder="<?php echo $text_email; ?>">
                <input type="submit" onclick="processSubscribe(<?php echo $module; ?>)" value="<?php echo $button_action; ?>" class="btn">
            </div>
        </div>
    </div>
</div>