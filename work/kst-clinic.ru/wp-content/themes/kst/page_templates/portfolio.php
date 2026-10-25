<?
/*
Template name: Наши работы

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
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 20px;">
			<div class="col col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" style="padding-left: 0px;">
				<select id="service" class="form-control">
					<option value="0">Выберите услугу</option>
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'services', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
?>
					<option value="<? echo $post->post_title; ?>"><? echo $post->post_title; ?></option>
<?  } ?>
				</select>
			</div>
			<!--<div class="col col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" style="padding-left: 0px;">
				<select id="doctor" class="form-control">
					<option value="0">Выберите доктора</option>
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'doctors', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
?>
					<option value="<? echo $post->post_title; ?>"><? echo $post->post_title; ?></option>
<?  } ?>
				</select>
			</div>-->
			<div class="col col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" style="padding-left: 0px;">
				<button class="btn btn-primary action" id="filter">Посмотреть</button>
			</div>
			<script>
			$(function(){
				$("#filter").on('click', function(){
					$(".portfolio_item").each(function(index, value){
						$(value).hide();
						if ($("#service").val() == 0)
						{
							/*if ($("#doctor").val() == 0) $(value).show();
							else if ($(value).attr('data-doctor') == $("#doctor").val())*/ $(value).show(); 
						}
						else
						{
							if ($(value).attr('data-service') == $("#service").val()) 
							{
								/*if ($("#doctor").val() == 0) $(value).show();
								else if ($(value).attr('data-doctor') == $("#doctor").val())*/ $(value).show(); 
							}
						}
					});
				});
			});		
			</script>
		</div>
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'portfolio', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$image = get_field('превью', $post->ID);
		$service = get_field('услуга', $post->ID);
		$doctor = get_field('врач', $post->ID);
		$title = $post->post_title;
?>	
		<div class="col col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 portfolio_item" data-service="<? echo $service->post_title; ?>" data-doctor="<? echo $doctor->post_title; ?>">
			<a href="<? echo get_post_permalink($post->ID); ?>" class="item_link">
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 review_image" style="padding: 0">
				
					<img src="<? echo $image['url']; ?>" height="100%" width="100%">
				</div>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 tech-info" style="padding: 0;">
					<table style="width: 100%;">
						<tr>
							<td style="height: 40px; font-size: 12px; text-align: center;"><? echo $service->post_title; ?></td>
						</tr>
						<tr>
							<td style="height: 150px;"><p style="text-align: center; font-size: 14px; color: #2d70cc;"><? echo $title; ?></p></td>
						</tr>
					</table>		
				</div>
			</a>
		</div>
<?  } ?>
	</div>
<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>