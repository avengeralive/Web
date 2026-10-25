<?php if (!empty($heading_title)) { ?>
<h3><?php echo $heading_title; ?></h3>
<?php } ?>
<div class="row author-block">
    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
        <img src="<?php echo $thumb; ?>" alt="<?php echo $name; ?>"/>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
        <b><?php echo $name; ?></b>
        <br/>
        <?php echo $description; ?>
    </div>
</div>