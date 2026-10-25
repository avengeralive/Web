<?
/*
Template name: Цены

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
	//$menu = wp_get_nav_menu_items('Главное меню');
?>	
		<h1 style="text-align: center; margin-bottom: 50px;"><span style="color: #32CD32;">Цены на услуги по диагностике заболеваний, лечению зубов, отбеливанию, протезированию.</span></h1>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-222" src="/wp-content/uploads/2017/08/имплантация.png" alt="" /></td>
					<td><span style="color: #32CD32;">Консультация врача</span></td>
					<td style="width: 50px; text-align: right; color: #32CD32;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			
</section>
<? get_footer(); ?>