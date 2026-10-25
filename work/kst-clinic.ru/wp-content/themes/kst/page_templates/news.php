<?
/*
Template name: Новости

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
?>
	<h1 style="text-align: left; margin-bottom: 40px;">Наши новости</h1>
		
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'news', 'order' => 'DESC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$desc = get_field('краткое_описание', $post->ID);
		$photo = get_field('обложка', $post->ID);
?>	
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-bottom: 40px;">
			<div class="col col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 docs" style="padding: 0px;">
				<img src="<? echo $photo['url']; ?>" style="width: 70%;">
			</div>
			<div class="col col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" itemid="<? echo get_post_permalink($post->ID); ?>" itemprop="mainEntityOfPage">
				<small><? echo $post->post_date; ?></small>
				<h3 style="color:#008080; margin-top: 20px; margin-bottom: 20px;" itemprop="headline"><font size="4"><? echo $post->post_title; ?></font></h3>
				<div itemprop="articleBody"><? echo $desc; ?></div>
				<br><br>
				<a href="<? echo get_post_permalink($post->ID); ?>">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
<?  } ?>	
	</div>
<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>