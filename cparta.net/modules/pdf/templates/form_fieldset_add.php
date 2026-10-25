<fieldset>
    <legend><?php echo $loc['nalojka.php']['t02']; ?></legend>
    <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo $loc['nalojka.php']['t03']; ?></label>
        <div class="col-sm-10">
            <input type="text" 
                   class="form-control" 
                   name="message"
                   value="<?php echo $loc['nalojka.php']['t04']; ?>"
                   >
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-3 checkbox">
            <label>
                <input type="checkbox" 
                   name="chb_pay_deliv"
                   checked
                   >
                <?php echo $loc['nalojka.php']['t05']; ?>
            </label>
        </div>
        <div class="col-sm-3 checkbox">
            <label>
                <input type="checkbox" 
                   name="chb_home_delivery"
                   checked
                   >
                <?php echo $loc['nalojka.php']['t06']; ?>
            </label>
        </div>
        <div class="col-sm-3 checkbox">
            <label>
                <input type="checkbox" 
                   name="chb_notice"
                   checked
                   >
                <?php echo $loc['nalojka.php']['t07']; ?>
            </label>
        </div>
    </div>
</fieldset>