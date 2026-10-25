<?
/*
Template name: Технологии

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
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'technology', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$icon = get_field('обложка', $post->ID);
		$desc = get_field('описание', $post->ID);
?>	
		<div class="col col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 technology_item">
			<div class="col col-12 col-sm-12 col-md-12 col-lg-1 col-xl-1"></div>
			<a href="<? echo get_post_permalink($post->ID); ?>">
				<div class="col col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 tech_image_back" style="padding: 0px;">
					<img src="<? echo $icon['url']; ?>" class="tech_front_img" style="width: 100%;">
				</div>
			</a>
			<div class="col col-12 col-sm-12 col-md-12 col-lg-1 col-xl-1"></div>
			<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 tech-info" style="padding: 0;">
				<table style="width: 100%;">
					<tr>
						<td class="tech_headi"><h4><a href="<? echo get_post_permalink($post->ID); ?>"><? echo $post->post_title; ?></a></h4></td>
					</tr>
					<tr>
						<td class="tech_desc"><p><? echo $desc; ?></p></td>
					</tr>
				</table>		
			</div>
		</div>
<?  } ?>	
	</div>
<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>