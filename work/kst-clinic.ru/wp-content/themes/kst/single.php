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

<? if ($category[0]->slug == 'uslugi') do_action('left_sidebar_service');
else do_action('left_sidebar');
 ?>
	<div class="col col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9" id="content">

<?

		if ($category[0]->slug == 'doctors') do_action('doctors_info', array('id' => get_the_ID()));
		else if ($category[0]->slug == 'technology') do_action('technology_info', array('id' => get_the_ID()));
		else if ($category[0]->slug == 'portfolio') do_action('portfolio_info', array('id' => get_the_ID()));
		else {
?>
		<article itemscope itemtype="http://schema.org/Article">
			<span itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
				<img itemprop="url image" src="https://kst-clinic.ru/wp-content/themes/kst/images/logo.png" style="display:none;" />
				<meta itemprop="width" content="64">
				<meta itemprop="height" content="64">
			</span><? $pt = get_post_type(get_the_ID()); //var_dump($pt); ?>
			<div itemid="<?php the_permalink() ?>" itemprop="mainEntityOfPage" <? if (!in_array($pt, array("services")))  { ?>style="display:none;"<? } ?>>
				<h1 itemprop="headline"><? the_title(); ?></h1>
			</div>
			<div itemprop="articleBody">
				<? the_content(); ?>
			</div>

			<? do_action('get_sub_posts', get_the_ID()); ?>

			<span itemprop="author"><a style="display:none;" href="https://kst-clinic.ru">Клиника Современных Технологий</a></span>
			<time class="post-time" itemprop="datePublished" datetime="<? the_date('Y-m-d'); ?>"></time>
			<time class="post-time" itemprop="dateModified" datetime="<? the_modified_time('Y-m-d'); ?>"></time>
			<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<img itemprop="url image" src="https://kst-clinic.ru/wp-content/themes/kst/images/logo.png" style="display:none;" />
					<meta itemprop="width" content="64">
					<meta itemprop="height" content="64">
				</div>
				<meta itemprop="name" content="Клиника женского и мужского здоровья">
				<meta itemprop="address" content="Москва, ул. Большой Головин переулок, д. 4">
			</div>
		</article>
<?
		}

		global $wp_query;
		$menu = wp_get_nav_menu_items('УСЛУГИ_'.get_the_title(get_the_ID()));

		if ($wp_query->query_vars['post_type'] == 'services' && !empty($menu)) {
?>
		<h4 style="text-align: left;" id="price">Стоимость</h4>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-222" src="<? do_action('getIcon', array('id' => get_the_ID())) ?>" alt="<? echo get_the_title(get_the_ID()); ?>" /></td>
					<td><span style="color: #004F6F;" itemprop="headline"><? echo get_the_title(get_the_ID()); ?></span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? //$menu = wp_get_nav_menu_items('УСЛУГИ_'.get_the_title(get_the_ID())); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplatauslugi'); return true;">Оплата услуг</a></li>
				<li><a style="cursor: pointer;" data-toggle="modal" data-target="#priem" class="zapisusl">Запись на приём</a></li>
			</ul>
			<script>
			jQuery(document).ready(function($){
				$('.zapisusl').click(function(){
					ym(42761559, 'reachGoal', 'zapisuslugi');
					//console.log('click zapisuslugi');
					$("#zapis_form").submit(function () {
						ym(42761559, 'reachGoal', 'otpravkazapisuslugi');
						//console.log('otpravka otpravkazapisuslugi');
					});
				});
			});
			</script>
		</div>
<span style="display:block; text-align: left; font-size: 1.rem;">* - Обращаем Ваше Внимание на то, что данный Интернет-ресурс носит исключительно информационный характер и не является публичной офертой!</span>
		<span style="display:block; text-align: left; font-size: 1.rem;">* - Прием специалистами клиники только по предварительной записи!</span>
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
					<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
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
