<?
/*
Template name: Врачи

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
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'doctors', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	$special = array();
	foreach ($posts_array as $key=>$post)
	{
		$spec = get_field('должность', $post->ID);
		$special[$spec] = 1;
	}
?>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 20px; padding: 0;">
		<div class="col col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4" style="padding: 0;">
			<select class="form-control" id="spec_filter">
				<option value="0">Все специальности</option>
<? foreach ($special as $key=>$item) { ?>
				<option value="<? echo $key; ?>"><? echo $key; ?></option>
<? } ?>
			</select>
		</div>
		<script>
		$(function(){
			$("#spec_filter").on('change', function(){
				$(".doc_item2").each(function(index, value){
					$(value).hide();
					if ($("#spec_filter").val() == 0) $(value).show();
					else
					{
						if ($(value).attr('data-name') == $("#spec_filter").val()) $(value).show();
					}
				});
			});
		});		
		</script>
	</div>
	
<?
	foreach ($posts_array as $key=>$post)
	{
		$name = get_field('имя', $post->ID);
		$last = get_field('фамилия', $post->ID);
		$father = get_field('отчество', $post->ID);
		$spec = get_field('должность', $post->ID);
		$photo = get_field('превью_фото', $post->ID);
?>	
		<div class="col col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 doc_item2" style="margin-bottom: 30px;" data-name="<? echo $spec; ?>">
			<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 doc_item"  style="padding: 0px;">
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 docs" style="padding: 0px;">
					<img src="<? echo $photo['url']; ?>" class="tech_front_img">
				</div>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
					<table style="width: 100%;">
						<tr>
							<td style="height: 80px;"><h4><? echo $last; ?> <? echo $name; ?> <? echo $father; ?></h4></td>
						</tr>
						<tr>
							<td style="height: 50px;"><p><? echo $spec; ?></p></td>
						</tr>
					</table>		
				</div>
				<a href="<? echo get_post_permalink($post->ID); ?>" class="panel-overlay text-uppercase">
					<span>Записаться на прием <i class="icon icon-arrow-right-line"></i></span>
				</a>
			</div>
		</div>
<?  } ?>	
	</div>
</section>
<? get_footer(); ?>