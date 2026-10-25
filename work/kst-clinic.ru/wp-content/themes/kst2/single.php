<? get_header(); ?>
<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 breadcrumbs">
<? bcn_display(); ?>
</div>
<section id="main-content">

<?
	while ( have_posts() ) : the_post();
		do_action('getBanner', array('id' => get_the_ID()));
		$category = get_the_category(get_the_ID());
?>

<? if ($category[0]->slug == 'services') do_action('left_sidebar_service');
else do_action('left_sidebar');
 ?>
	<div class="col col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9" id="content">
<?
		
		if ($category[0]->slug == 'doctors') do_action('doctors_info', array('id' => get_the_ID()));
		else if ($category[0]->slug == 'technology') do_action('technology_info', array('id' => get_the_ID()));
		else if ($category[0]->slug == 'portfolio') do_action('portfolio_info', array('id' => get_the_ID()));
		else the_content();
		
		if ($category[0]->slug == 'services')
		{
?>
		<h2 style="text-align: left;" id="price">Стоимость</h2>			
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-222" src="<? do_action('getIcon', array('id' => get_the_ID())) ?>" alt="" /></td>
					<td><span style="color: #32CD32;"><? echo get_the_title(get_the_ID()); ?></span></td>
					<td style="width: 50px; text-align: right; color: #32CD32;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_'.get_the_title(get_the_ID()));  ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/%D0%B8%D0%BD%D0%BE%D0%B3%D0%BE%D1%80%D0%BE%D0%B4%D0%BD%D0%B8%D0%BC-%D0%BF%D0%B0%D1%86%D0%B8%D0%B5%D0%BD%D1%82%D0%B0%D0%BC/">Иногородним пациентам</a></li>
				<li><a href="/patients/оплата-услуг/">Оплата услуг</a></li>
			</ul>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 30px;">
		<div class="list-group" id="list-items-serv-mob">
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'services', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	$id = get_the_ID();
	foreach ($posts_array as $key=>$post)
	{
?>
		<a href="<? echo get_post_permalink($post->ID); ?>" class="list-group-item list-group-item-action <? if ($post->ID == $id) echo 'active'; ?>"><? echo $post->post_title; ?></a>
	<? } ?>
	</div>
	</div>
<?
		}
		if ($category[0]->slug == 'technology')
		{
?>
			<? $menu = wp_get_nav_menu_items('ТЕХНОЛОГИИ_'.get_the_title(get_the_ID())); 
			?>
			<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<ul class="oglavl">
					<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
					<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
					<? } ?>
				</ul>
				<ul class="features">
					<li><span class="cards-icons">Visa, Mastercard</span></li>
					<li><a href="/patients/%D0%B8%D0%BD%D0%BE%D0%B3%D0%BE%D1%80%D0%BE%D0%B4%D0%BD%D0%B8%D0%BC-%D0%BF%D0%B0%D1%86%D0%B8%D0%B5%D0%BD%D1%82%D0%B0%D0%BC/">Иногородним пациентам</a></li>
					<li><a href="/patients/оплата-услуг/">Оплата услуг</a></li>
				</ul>
			</div>
<?
		}
	endwhile;
?>	
	</div>
</section>
<? get_footer(); ?>