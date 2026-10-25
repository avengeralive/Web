<?
/*
Template name: Отзывы

*/
get_header(); ?>
<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 breadcrumbs">
<? bcn_display(); ?>
</div>
<section id="main-content">
<? do_action('left_sidebar'); ?>
	<div class="col col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9" id="content">
<?
	while ( have_posts() ) : the_post();
		$banner = get_field('баннер_страницы', get_the_ID());
		$banner_title = get_field('запись_на_баннере', get_the_ID());
?>
		<script>
			$('.parallax-window').parallax({imageSrc: '<? echo $banner['url']; ?>'});
			$('#banner_title').html('<? echo $banner_title; ?>');
		</script>
		<div class="col col-12 col-sm-8 col-md-9 col-lg-9 col-xl-9" style="padding: 0px;">
			<h2 style="text-align: left;">Отзывы</h2>
		</div>
		<div class="col col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3" style="padding: 0px;">
			<button class="btn btn-primary action" data-toggle="modal" data-target="#otziv" style="width: 100%; padding: 10px;">Оставить отзыв</button>
		</div>
<?
		the_content();
	endwhile;
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'reviews');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$photo = get_field('фотография', $post->ID);
?>	
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; border: 1px solid #32CD32; margin-top: 20px; margin-bottom: 10px; position: relative;">
			<a href="<? echo get_post_permalink($post->ID); ?>" class="item_link">
				<div class="col col-12 col-sm-8 col-md-9 col-lg-9 col-xl-9" style="padding: 15px;">
					<h3 style="text-align: left; color: #32CD32;"><? echo $post->post_title; ?></h3>
					<? echo $post->post_content; ?>
					<br>
				</div>
				<div class="col col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 review_image" style="padding:0px; border-left: 1px solid #32CD32;">
					<img src="<? echo $photo['url']; ?>" style="width: 100%;">
				</div>
			</a>
			<a class="forw" href="<? echo get_post_permalink($post->ID); ?>">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
		</div>
<?  } 

	$args = array( 'posts_per_page'   => 999, 'category_name' => 'reviews_1');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$serv = get_field('услуги', $post->ID);
?>			
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 30px; margin-bottom: 10px; position: relative;">
			<h3 style="text-align: left; color: #000;"><? echo $post->post_title; ?><span style="text-align: right;"><? $post->post_date; ?></span></h3>
			<div style="height: 0px; width: 100%; border-top: 1px solid #32CD32; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
			<? echo $post->post_content; ?>
			<h5 style="text-align: left; color: #000; margin-top: 20px; font-weight: bold;">Оказанные услуги</h5>
			<? echo $serv; ?>
		</div>
<?  } ?>	
	</div>
</section>
<? get_footer(); ?>