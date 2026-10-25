<?
/*
Template name: Поиск

*/
get_header(); ?>

<section id="main-content">
<? do_action('left_sidebar'); ?>
	<div class="col col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9" id="content">
<?
	while ( have_posts() ) : the_post();
		$banner = get_field('баннер_страницы', 5);
		
		$banner_title = 'Результаты поиска';
?>
		<h1>Поиск по клинике</h1>
		<script>
			$('.parallax-window').parallax({imageSrc: '<? echo $banner['url']; ?>'});
			$('#banner_title').html('<? echo $banner_title; ?>');
		</script>
<?
	endwhile;
	global $wpdb;
	$posts = $wpdb->get_results('SELECT ID, post_title FROM wp_posts WHERE (post_content LIKE "%'.$_GET['q'].'%" OR post_title LIKE "%'.$_GET['q'].'%") AND (post_type = "post" OR post_type = "page" OR post_type = "services" ) AND post_status = "publish"');
?>			
<?
		foreach ($posts as $post) {
?>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-bottom: 20px;">
			<a href="<? echo get_post_permalink($post->ID); ?>" style="text-decoration: none;">
				<h2 style="text-align: left;"><? echo $post->post_title; ?></h2>
			Подробнее <i class="fa fa-arrow-circle-right"></i></a>
			<div style="height: 0px; width: 100%; border-top: 1px solid #2d70cc; padding-left: 10px; margin-bottom:20px; margin-top: 20px;"></div>
		</div>	
		<? }?>	
	</div>
<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>