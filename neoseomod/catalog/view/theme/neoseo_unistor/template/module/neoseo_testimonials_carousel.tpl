<?php if($total != 0) { ?>
<div class="module">
    <h3 class="carousel-title col-xs-6 col-sm-6"><?php echo $testimonial_title; ?></h3>
    <div class="show_more text-right col-xs-6 col-sm-6">
        <a href="<?php echo $showall_url; ?>" title="<?php echo $show_all; ?>"><i class="fa fa-eye"></i><span><?php echo $show_all; ?></span></a>
    </div>
    <div class="row">
    <div class="carousel-mode col-xs-12">
        <div id="testimonials-<?php echo $module; ?>" class="owl-carousel carousel-t testimonial-container">
            <?php foreach ($testimonials as $testimonial) { ?>
            <div class="item">
                <div class="name">
                    <a href="<?php echo $testimonial['href']; ?>"><b><?php echo $testimonial['name']; ?></b></a>
                </div>
                <?php if ($testimonial['rating']) { ?>
                <div class="rating">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <?php if ($testimonial['rating'] < $i) { ?>
                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                    <?php } else { ?>
                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                    <?php } ?>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php if ($testimonial['youtube']) { ?>
                <div class="youtube"><?php echo $testimonial['youtube']; ?></div>
                <?php } ?>
                <?php if ($testimonial['user_image']) { ?>
                <div class="user-image"><img src="<?php echo $testimonial['user_image']; ?>" /></div>
                <?php } ?>
                <div class="description"><i><?php echo $testimonial['description']; ?></i></div>
            </div>
            <?php } ?>
        </div>
    </div>
    <script type="text/javascript"><!--
		$('#testimonials-<?php echo $module; ?>').owlCarousel({
			items: 1,
			autoPlay: 5000,
			navigation: true,
			navigationText: ['<a class="btn btn-secondary prev"><i class="icon-arrow-pointing-left"></i></a>', '<a class="btn btn-secondary next"><i class="icon-right-arrow"></i></a>'],
			pagination: false,
			singleItem: true
		});
		--></script>
    </div>
</div>
<?php } ?>