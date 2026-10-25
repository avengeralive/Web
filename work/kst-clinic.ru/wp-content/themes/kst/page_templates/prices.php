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
		<h1 style="text-align: center; margin-bottom: 50px;"><span style="color: #004F6F;" itemprop="headline">Прейскурант на медицинские услуги ЗАО "КСМТ" от 05.04.2018 г.</span></h1>
<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/08/нерперативная-гинекология-1.png" alt="Неоперативная гинекология" width="50" height="50" /></td>
					<td><span style="color: #004F6F;">Неоперативная гинекология</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Неоперативная гинекология'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
                    <?php// echo "<pre>"; print_r($menu); echo "</pre>"; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		
		
		
		
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/08/нерперативная-гинекология-1.png" alt="Отделение лечения крауроза вульвы" width="50" height="50" /></td>
					<td><span style="color: #004F6F;">Отделение лечения крауроза вульвы</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Лечение крауроза вульвы лазером'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
                    <?php// echo "<pre>"; print_r($menu); echo "</pre>"; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/"  onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-222" src="/wp-content/uploads/2017/08/ведение-беременности.png" alt="Прерывание беременности" /></td>
					<td><span style="color: #004F6F;">Прерывание беременности</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Прерывание беременности'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
                    <?php// echo "<pre>"; print_r($menu); echo "</pre>"; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>	
		
		
		
		
		
		
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/лазерное_лечение.png" alt="Лечение CO2 лазером" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">Лечение CO2 лазером</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Лечение CO2 лазером'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
			
		</div>








		
<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-222" src="/wp-content/uploads/2017/08/ведение-беременности.png" alt="Ведение беременности" /></td>
					<td><span style="color: #004F6F;">Ведение беременности</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Ведение беременности'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>

		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/08/оперативная-гинекология-1.png" alt="Оперативная гинекология" width="60" height="50" /></td>
					<td><span style="color: #004F6F;">Оперативная гинекология</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Оперативная гинекология'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-222" src="/wp-content/uploads/2017/08/ведение-беременности.png" alt="Прерывание нежелательной беременности" /></td>
					<td><span style="color: #004F6F;">Прерывание нежелательной беременности</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Прерывание нежелательной беременности'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>

		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/08/эстетическая-1.png" alt="Эстетическая гинекология" width="50" height="50" /></td>
					<td><span style="color: #004F6F;">Эстетическая гинекология</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Эстетическая гинекология'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/анализы.png" alt="" width="55" height="50" /></td>
					<td><span style="color: #004F6F;">ХРОМАТО-МАСС-СПЕКТРОМЕТРИЯ</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_ХМС'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/08/неоперативная-урология-1.png" alt="Урология" width="50" height="50" /></td>
					<td><span style="color: #004F6F;">Урология</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Урология'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/оперативная-урология-1.png" alt="Оперативная урология" width="60" height="50" /></td>
					<td><span style="color: #004F6F;">Оперативная урология</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Оперативная урология'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136"  src="/wp-content/uploads/2017/09/анализы.png" alt="Анализы и лабораторная диагностика" width="55" height="50" /></td>
					<td><span style="color: #004F6F;">Анализы и лабораторная диагностика</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Анализы и лабораторная диагностика'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		<!--<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/справмк.png" alt="Медицинские справки и больничные листы" width="35" height="50" /></td>
					<td><span style="color: #004F6F;">Медицинские справки и больничные листы</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Медицинские справки и больничные листы'); ?>
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
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>-->
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/дневнгй-стационар-1.png" alt="Дневной стационар" width="60" height="50" /></td>
					<td><span style="color: #004F6F;">Дневной стационар</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Дневной стационар'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		<!--<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/ПРОЦЕДУРНОЕ-ДЕЛО.png" alt="" width="60" height="50" /></td>
					<td><span style="color: #004F6F;">Процедурное дело</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Процедурное дело'); ?>
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
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>-->
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/операц-блок-1.png" alt="Операционный блок" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">Операционный блок</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Операционный блок'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
		<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/флебология-1.png" alt="Флебология" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">Флебология</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Флебология'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>






<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		
	<!--	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/маммология-1.png" alt="" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">Маммология</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Маммология'); ?>
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
			
			
			
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>-->	
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/узи-1.png" alt="УЗИ-диагностика" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">УЗИ-диагностика</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_УЗИ-диагностика'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>			
			
			
			
			
			
			<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
		</div>
		
		<!--<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/терапия-1.png" alt="" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">Терапия</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Терапия'); ?>
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
			
		-->	
			
			
				
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/гинекология.png" alt="Гинекология кабинет SMART инноваций" width="32" height="60" /></td>
					<td><span style="color: #004F6F;">Гинекология "кабинет SMART инноваций"</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Гинекология "SMART инноваций"'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
			
		</div>
		
			<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/манипуляции.png" alt="Манипуляции кабинет SMART инноваций" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">Манипуляции "кабинет SMART инноваций"</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Манипуляции'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
			
		</div>
		
		
			<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/медикаментозное_лечение.png" alt="Медикаментозное лечение (удаление) кабинет SMART инноваций" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">Медикаментозное лечение (удаление) "кабинет SMART инноваций"</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Медикаментозное лечение (удаление) "кабинет SMART инноваций"'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
			
		</div>
		
			<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/узи1.png" alt="УЗИ кабинет SMART инноваций" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">УЗИ "кабинет SMART инноваций"</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_УЗИ "кабинет SMART инноваций"'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
			
		</div>
		
		
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<table class="price-head" style="width: 100%;">
				<tr>
					<td style="width: 50px;"><img class="alignnone size-full wp-image-136" src="/wp-content/uploads/2017/09/лазерное_лечение.png" alt="Фракционное лазерное лечение кабинет SMART инноваций" width="42" height="50" /></td>
					<td><span style="color: #004F6F;">Фракционное лазерное лечение "кабинет SMART инноваций"</span></td>
					<td style="width: 50px; text-align: right; color: #004F6F;"><i class="fa fa-arrow-circle-down"></i></td>
				</tr>
			</table>
			<? $menu = wp_get_nav_menu_items('УСЛУГИ_Фракционное лазерное лечение'); ?>
			<ul class="oglavl">
				<? foreach ($menu as $item) { $title = explode('|', $item->title)[0]; $price = explode('|', $item->title)[1]; ?>
				<li><span class="text"><? echo $title; ?></span><span class="page"><? echo $price; ?> <i class="fa fa-rub"></i></span></li>
				<? } ?>
			</ul>
			<ul class="features">
				<li><span class="cards-icons">Visa, Mastercard</span></li>
				<li><a href="/patients/лечение-по-дмс/">Лечение по ДМС</a></li>
				<li><a href="/patients/оплата-услуг/" onclick="ym(42761559, 'reachGoal', 'oplataprices'); return true;">Оплата услуг</a></li>
			</ul>
<div style="height: 0px; width: 100%; border-top: 1px solid #004F6F; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
			
		</div>
<span style="display:block; text-align: left; font-size: 1.rem;">* - Обращаем Ваше Внимание на то, что данный Интернет-ресурс носит исключительно информационный характер и не является публичной офертой!</span>
<span style="display:block; text-align: left; font-size: 1.rem;">* - Прием специалистами клиники только по предварительной записи!</span>		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	</div>
<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>