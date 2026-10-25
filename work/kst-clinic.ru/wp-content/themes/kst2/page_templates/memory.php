<?
/*
Template name: Памятка

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
<?
		the_content();
	endwhile;
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'memory', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
?>	
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-bottom: 40px; text-align: left;">
			<a href="<? echo get_post_permalink($post->ID); ?>" style="text-decoration: none;"><h3 style="color: #2d70cc; font-weight: bold; margin-bottom: 30px;"><? echo $post->post_title; ?></h3>
			Описание <i class="fa fa-arrow-circle-right"></i></a>
		</div>
<?  } ?>	
	
	</div>
</section>
<? get_footer(); ?>