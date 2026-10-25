<?
/*
Template name: Пациентам

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
		$args = array( 'posts_per_page' => 999, 'post_parent' => get_the_ID(), 'post_type' => 'page', 'order' => 'ASC');
	endwhile;
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$icon = get_field('иконка', $post->ID);
?>	
		<div class="col col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 item">
			<table style="margin-bottom: 20px;">
				<tr>
					<td style="width: 100px; text-align: center;"><img src="<? echo $icon['url']; ?>"></td>
					<td style="padding: 10px;"><a href="<? echo get_post_permalink($post->ID); ?>" class="serv_link"><? echo $post->post_title; ?></a></td>
				</tr>
			</table>
		</div>
<?  } ?>	
	</div>
</section>
<? get_footer(); ?>