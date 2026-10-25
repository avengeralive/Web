<div <?php if ($is_home && $menu_type) {?>class="side-slideshow"<?php } ?>>
<div id="slideshow_wrap_<?php echo $module; ?>">
	<div class="row">
		<div class="slideshow-container col-xs-12 <?php if ($banners2) { ?>col-md-8<?php } ?>">
			<div id="slideshow<?php echo $module; ?>" class="owl-carousel slideshow owl-hide box-shadow box-corner">
				<?php foreach ($banners as $banner) { ?>
				<div class="item">
					<?php if ($banner['link']) { ?>
					<a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
					<?php } else { ?>
					<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
        <?php if ($banners2) { ?>
		<div class="col-xs-12 col-md-4">
			<div id="banner<?php echo $module; ?>" class="banner-<?php echo count($banners2) ; ?>">
				<?php foreach ($banners2 as $banner) { ?>
				<div class="hidden-xs col-md-12 col-sm-6 item owl-wrapper-outer">
					<?php if ($banner['link']) { ?>
					<a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
					<?php } else { ?>
					<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
        <?php } ?>
	</div>
</div>
</div>
<script>
$('#slideshow<?php echo $module; ?>').owlCarousel({
    loop:true,
    items:1,
    autoplay: true,
    autoplayTimeout: 3000,
    nav: true,
    navText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
});

$(document).ready(function () {
	$('.slideshow .owl-nav').prependTo('.slideshow .owl-stage-outer').css('opacity','1');

});

</script>