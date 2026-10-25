<?
/*
Template name: Оплата услуг

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
		<h1 style="text-align: left; margin-bottom: 40px;">Оплата услуг</h1>
		<form id="payment" onsubmit="ym(42761559, 'reachGoal', 'otpravkaoplpatients'); return true;">
			<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;">
				<input type="text" class="form-control" name="amount" placeholder="Укажите сумму платежа">
			</div>
			<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;">
				<input type="text" class="form-control" name="id" placeholder="Номер договора пациента">
			</div>
			<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;">
				<input type="text" class="form-control" name="fio" placeholder="Фамилия, имя и отчество пациента">
			</div>
			<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;">
				<p>После нажатия на кнопку ОПЛАТИТЬ вы будете перенаправлены на сайт платежной системы ЯНДЕКС КАССА, где сможете выбрать удобный способ оплаты. Срок поступления оплаты в КСТ - до 24 часов.</p>
				<p class="features"><span class="cards-icons">Visa, Mastercard</span></p>
				<p>Нажимая на кнопку ОПЛАТИТЬ, я даю свое согласие на обработку компанией КСТ моих персональных данных в соответствии с требованиями Федерального закона от 27.07.2006г. № 152-ФЗ «О персональных данных» и Политикой обработки и защиты персональных данных КСТ.</p>
			</div>
			<div class="form-group col doc col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3" style="padding: 0px;">
				<button type="submit" class="btn btn-primary">Оплатить</button>
			</div>					
		</form>
	</div>
<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>