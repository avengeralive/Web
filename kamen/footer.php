<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitronic2\Mobile;
use Yenisite\Core\Tools;
global $rz_b2_options;
//@var $arDefIncludeParams set in header.php
?>

<? //Add Kuznetsov S.A. 2016-12-22 Begin

session_start();
$ses_msg = 'msg_work_2017-06';
if(time() < strtotime('2017-06-09'))
if(!isset($_SESSION[$ses_msg]) || !$_SESSION[$ses_msg])
{
?>
<sc ript type="text/javascript">
<!--
var Dialog = new BX.CDialog({
   //title: "Режим работы",
   title: "Важная информация!",
   head: '',
   //content: 'Дорогие друзья! Коллектив нашей Компании  поздравляет всех с «Днём Труда»! <br>Обращаем Ваше внимание, что <br>29, 30 апреля и 1 мая являются выходными днями. <br>Заказы, сделанные в этот период, поступят в обработку 2 мая.',
   content: 'В связи с проведением технических работ <br><b style="color:red">сегодня 8 июня 2017 года  <br>салоны в Москве и склад в Климовске <br>работают до 15.00</b><br>Приносим свои извинения за доставленное неудобство.',
   icon: 'head-block',

   resizable: true,
   draggable: true,
   height: '168',
   width: '400',
   buttons: [BX.CDialog.btnClose]
});
Dialog.Show();
Dialog.Move(-Dialog.PARAMS.width/2,-Dialog.PARAMS.height/2);
//-->
</sc ript>
<?
$_SESSION[$ses_msg] = true;
}
//Add Kuznetsov S.A. 2016-12-22 End
?>
<?
$APPLICATION->IncludeComponent("bitrix:news.list", "news_all", Array(
   "ACTIVE_DATE_FORMAT" => "d.m.Y",   // Формат показа даты
      "ADD_SECTIONS_CHAIN" => "N",   // Включать раздел в цепочку навигации
      "AJAX_MODE" => "N",    // Включить режим AJAX
      "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
      "AJAX_OPTION_HISTORY" => "N",  // Включить эмуляцию навигации браузера
      "AJAX_OPTION_JUMP" => "N", // Включить прокрутку к началу компонента
      "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
      "CACHE_FILTER" => "N", // Кешировать при установленном фильтре
      "CACHE_GROUPS" => "N", // Учитывать права доступа
      "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
      "CACHE_TYPE" => "N",   // Тип кеширования
      "CHECK_DATES" => "Y",  // Показывать только активные на данный момент элементы
      "COMPONENT_TEMPLATE" => "support",
      "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
      "DISPLAY_BOTTOM_PAGER" => "Y", // Выводить под списком
      "DISPLAY_DATE" => "Y", // Выводить дату элемента
      "DISPLAY_NAME" => "Y", // Выводить название элемента
      "DISPLAY_PICTURE" => "Y",  // Выводить изображение для анонса
      "DISPLAY_PREVIEW_TEXT" => "Y", // Выводить текст анонса
      "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
      "FIELD_CODE" => array(0 => "DETAIL_PICTURE"),
      "FILTER_NAME" => "arrErFilter",    // Фильтр
      "HIDE_LINK_WHEN_NO_DETAIL" => "N", // Скрывать ссылку, если нет детального описания
      "IBLOCK_ID" => 12, // Код информационного блока
      "IBLOCK_TYPE" => "services",   // Тип информационного блока (используется только для проверки)
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
      "INCLUDE_SUBSECTIONS" => "Y",  // Показывать элементы подразделов раздела
      "MESSAGE_404" => "",   // Сообщение для показа (по умолчанию из компонента)
      "NEWS_COUNT" => "3",  // Количество новостей на странице
      "PAGER_BASE_LINK_ENABLE" => "N",   // Включить обработку ссылок
      "PAGER_DESC_NUMBERING" => "N", // Использовать обратную навигацию
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",  // Время кеширования страниц для обратной навигации
      "PAGER_SHOW_ALL" => "N",   // Показывать ссылку "Все"
      "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
      "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
      "PAGER_TITLE" => "Новости",    // Название категорий
      "PARENT_SECTION" => "",    // ID раздела
      "PARENT_SECTION_CODE" => "",   // Код раздела
      "PREVIEW_TRUNCATE_LEN" => "",  // Максимальная длина анонса для вывода (только для типа текст)
      "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
      "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
      "SET_META_DESCRIPTION" => "N", // Устанавливать описание страницы
      "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
      "SET_STATUS_404" => "N",   // Устанавливать статус 404
      "SET_TITLE" => "N",    // Устанавливать заголовок страницы
      "SHOW_404" => "N", // Показ специальной страницы
      "SORT_BY1" => "ID",    // Поле для первой сортировки новостей
      "SORT_BY2" => "SORT",  // Поле для второй сортировки новостей
      "SORT_ORDER1" => "DESC",   // Направление для первой сортировки новостей
      "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
   ),
   false
);
?>

<div class="footer-middle wow fadeIn" style="background: <?=$rz_b2_options['color-footer']?>; color: <?=$rz_b2_options['color-footer-font']?>"><?//COLOR?>
	<div class="container">
    <div class="row">
		<? /*<a href="/news/xx_international_exhibition_for_professionals_in_the_hospitality_industry_pir_expo.html"><div style="margin-top:10px; padding-left:15px;"><img src="<?=SITE_TEMPLATE_PATH?>/img/pir/pir01.jpg"><img src="<?=SITE_TEMPLATE_PATH?>/img/pir/pir02.jpg"></div></a> */?><?//Add Kuznetsov S.A. 2017-09-18?>
			<div class="col-md-6 col-sm-12">
				<?
				$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/contact_info_title.php")), false, array("HIDE_ICONS"=>"N"));

				Tools::includePostfixArea($pf, SITE_DIR . "include_areas/footer/address.php", true);

				/*Tools::includePostfixArea($pf, SITE_DIR . "include_areas/footer/email.php", true);*/
				?>
			</div>
			<div class="col-xs-122 payment-systems" style="width: 78%">
				<?
				$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/payment_systems.php")), false, array("HIDE_ICONS"=>"N"));

				$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/payment_systems_info.php")), false, array("HIDE_ICONS"=>"N"));
				?>

			</div>
			<div class="social-footer" style="margin-top: 56px; padding-right: 0px"><noindex><nofollow>
					<a target="_blank" rel="nofollow" href="https://vk.com/restoracia77"><img src="/images/VK.png"></a>
					<a target="_blank" rel="nofollow" href="https://www.instagram.com/restoracia.msk/"><img src="/images/instagram.png"></a>
					<a target="_blank" rel="nofollow" href="https://twitter.com/Restoraciamsk"><img src="/images/twitter.png"></a>
					<a target="_blank" rel="nofollow" href="https://www.facebook.com/%D0%A0%D0%B5%D1%81%D1%82%D0%BE%D1%80%D0%B0%D1%86%D0%B8%D1%8F-359866140757607/"><img src="/images/FB.png"></a>
					<a target="_blank" rel="nofollow" href="https://www.youtube.com/channel/UCPnaEjCDfMCqP_gxbkiYiDQ"><img src="/images/you_tube.png"></a>
                    <a target="_blank" rel="nofollow" href="https://plus.google.com/+%D0%9C%D0%B5%D0%B1%D0%B5%D0%BB%D1%8C%D0%A0%D0%B5%D1%81%D1%82%D0%BE%D1%80%D0%B0%D1%86%D0%B8%D1%8F"><img src="/images/g+.png"></a> 
						</nofollow></noindex></div>
		</div>
        <div class="copyright">

			<?$frame = new \Bitrix\Main\Page\FrameBuffered("rz_dynamic_full_mode");
			$frame->begin('');
				if(mobile::isMobile(false)):?>
					<div><a class="link" href="?<?=mobile::fullModeName?>=<?=mobile::isFullMode() ? 'N' : 'Y'?>"><?=mobile::isFullMode() ? GetMessage('BITRONIC2_FOOTER_MOBIL_MODE') : GetMessage('BITRONIC2_FOOTER_FULL_MODE')?></a></div>
				<?endif;
			$frame->end();
			$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/copyright.php")), false, array("HIDE_ICONS"=>"N"));

			$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/shop_name.php")), false, array("HIDE_ICONS"=>"N"));
			?>
            <br>
			<nav class="footer-nav">
			<?
			$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/links.php")), false, array("HIDE_ICONS"=>"N"));
			?>

		</nav>
		</div>
		<!--<div class="info-text">
			<?
			Tools::includePostfixArea($pf, SITE_DIR . "include_areas/footer/info_text.php", true);
			?>
		</div>-->


	</div>
    <div class="counters-and-logos">

			<div id="bx-composite-banner">
			</div>
		</div>
</div>
<!--<div class="footer-bottom wow fadeIn" data-wow-offset="0">
	<div class="container clearfix">

		<div class="developed-by">
			<?
			$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/romza.php")), false, array("HIDE_ICONS"=>"N"));
			?>
		</div>
	</div>
</div>-->

</div><!-- /big-wrap --><? // opened in header.php ?>

<!-- MODALS -->
<div class="modal modal_success" id="modal_success" role="dialog" tabindex="-1">
	<div class="alert success">
		<i class="flaticon-close47 btn-close" data-toggle="modal" data-target="#modal_success"></i>
		<div class="alert-header">
			<i class="flaticon-check14"></i>
			<?//title?>
		</div>
		<div class="alert-text">
			<?//text?>
		</div>
		<div class="line"></div>
		<button type="button" class="btn-main" data-toggle="modal" data-target="#modal_success"><?=GetMessage('BITRONIC2_MODAL_BUTTON_TEXT')?></button>
	</div>
</div>
<div class="modal modal_fail" id="modal_fail" role="dialog" tabindex="-1">
	<div class="alert fail">
		<i class="flaticon-close47 btn-close" data-toggle="modal" data-target="#modal_fail"></i>
		<div class="alert-header">
			<i class="flaticon-close47"></i>
			<span class="alert-title"><?//title?></span>
		</div>
		<div class="alert-text"><?//text?></div>
		<div class="line"></div>
		<button type="button" class="btn-main" data-toggle="modal" data-target="#modal_fail"><?=GetMessage('BITRONIC2_MODAL_BUTTON_TEXT')?></button>
	</div>
</div>
<div class="modal fade" id="modal_quick-view" tabindex="-1">
	<div class="modal-dialog modal_quick-view">
		<button class="btn-close" data-toggle="modal" data-target="#modal_quick-view">
			<span class="btn-text"><?=GetMessage('BITRONIC2_MODAL_CLOSE')?></span>
			<i class="flaticon-close47"></i>
		</button>
		<div class="modal_quick-view_content">
			<?=GetMessage('BITRONIC2_LOADING')?>

		</div>
		<a href="#" class="flaticon-arrow133 arrow prev"></a>
		<a href="#" class="flaticon-right20 arrow next"></a>
	</div><!-- /.modal-dialog -->
</div><!-- /#modal_calc-delivery.moda.fade.modal-form -->
<div class="modal fade modal-form" id="modal_registration" tabindex="-1">
	<div class="modal-dialog">
		<button class="btn-close" data-toggle="modal" data-target="#modal_registration">
			<span class="btn-text"><?=GetMessage('BITRONIC2_MODAL_CLOSE')?></span>
			<i class="flaticon-close47"></i>
		</button>
		<div class="content">
		</div>
	</div>
</div>
<?
$APPLICATION->ShowViewContent('bitronic2_settings');
$APPLICATION->ShowViewContent('bitronic2_modal_login');
//$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/header/user_reg.php")), false, array("HIDE_ICONS"=>"Y"));
$APPLICATION->ShowViewContent('bitronic2_modal_callme');
$APPLICATION->ShowViewContent('bitronic2_modal_detail');
// SUBSCRIBE PRODUCT
\Yenisite\Core\Tools::IncludeArea('footer', 'modal_subscribe');

// ADD2BASKET_POPUP
if($rz_b2_options['addbasket_type'] == 'popup'):
?>
<div class="modal fade" id="modal_basket" tabindex="-1">
	<div class="modal-dialog modal_basket">
		<button class="btn-close" data-toggle="modal" data-target="#modal_basket">
			<span class="btn-text"><?=GetMessage('BITRONIC2_MODAL_CLOSE')?></span>
			<i class="flaticon-close47"></i>
		</button>
		<div class="content"></div>
	</div>
</div>
<? endif;

// ONE_CLICK
if (CModule::IncludeModule('yenisite.oneclick')):
?>
<div class="modal fade modal-form" id="modal_quick-buy" tabindex="-1">
	<div class="modal-dialog">
		<button class="btn-close" data-toggle="modal" data-target="#modal_quick-buy">
			<span class="btn-text"><?=GetMessage('BITRONIC2_MODAL_CLOSE')?></span>
			<i class="flaticon-close47"></i>
		</button>
		<div class="content"></div>
	</div>
</div>
<? endif;

// ### FORM CALL ME
if(CModule::IncludeModule("yenisite.feedback")):?>
<div class="modal fade modal-form modal_callme" id="modal_callme" tabindex="-1">
	<div class="modal-dialog">
		<button class="btn-close" data-toggle="modal" data-target="#modal_callme">
			<span class="btn-text"><?=GetMessage('BITRONIC2_MODAL_CLOSE')?></span>
			<i class="flaticon-close47"></i>
		</button>
		<div class="content"></div>
	</div>
</div>
<?
// ### FORM FEEDBACK
?>
<div class="modal fade modal-form modal_feedback" id="modal_feedback" tabindex="-1">
	<div class="modal-dialog">
		<button class="btn-close" data-toggle="modal" data-target="#modal_feedback">
			<span class="btn-text"><?=GetMessage('BITRONIC2_MODAL_CLOSE')?></span>
			<i class="flaticon-close47"></i>
		</button>
		<div class="content"></div>
	</div>
</div>
<?
// ### FORM PRODUCT CONTACT
?>
<div class="modal fade modal-form modal_feedback" id="modal_contact_product">
	<div class="modal-dialog">
		<button class="btn-close" data-toggle="modal" data-target="#modal_contact_product">
			<span class="btn-text"><?=GetMessage('BITRONIC2_MODAL_CLOSE')?></span>
			<i class="flaticon-close47"></i>
		</button>
		<div class="content"></div>
	</div>
</div>
<?endif;

if (CRZBitronic2Settings::isPro($withGeoip = true)) {
	if ($APPLICATION->GetCurDir() == SITE_DIR) {
		CYSGeoIPStore::setMetaTags();
	}
}

// FOR SET PARAMS OF AJAX COMPONENTS
if ($USER->IsAdmin())
{
	$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/callme.php", "EMPTY" => true)), false, array("HIDE_ICONS"=>"Y"));
	$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/footer/feedback.php", "EMPTY" => true)), false, array("HIDE_ICONS"=>"Y"));
	//$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/header/user_reg.php", "EMPTY" => true)), false, array("HIDE_ICONS"=>"Y"));
	$APPLICATION->IncludeComponent("bitrix:main.include", "", array_merge($arDefIncludeParams,array("PATH" => SITE_DIR."include_areas/catalog/one_click.php", "EMPTY" => true)), false, array("HIDE_ICONS"=>"Y"));
}
?>
<?/* TODO
<? include '_/modals/modal_yourcity.html'; ?>
<? include '_/modals/modal_place-order.html'; ?>
<? include '_/modals/modal_inform-when-in-stock.html'; ?>
<? include '_/modals/modal_feedback.html'; ?>
<? include '_/modals/modal_address-on-map.html';
*/?>
<?$APPLICATION->ShowViewContent('modal_city_select');?>
<?$APPLICATION->ShowViewContent('modal_store_select');?>
<!-- END OF MODALS -->

<?$frame = new \Bitrix\Main\Page\FrameBuffered("rz_dynamic_flashmessage")?>
<?$frame->setAssetMode(\Bitrix\Main\Page\AssetMode::STANDARD) // YOU NEED IT TO PREVENT JS AND CSS FROM REWRITING COMPOSITE CACHE?>
<?$frame->begin('')?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/footer/flashmessage.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"Y"));?>
<?$frame->end()?>
<?
$panelPath = $_SERVER['DOCUMENT_ROOT'] . SITE_DIR . '/rz_panel/index.php';
if (file_exists($panelPath) && $_REQUEST['no_statistic'] !== 'y') {
	include $panelPath;
}
?>
<noindex><nofollow>


<? // Add Kuznetsov S.A. 2017-10-18 Begin callbackkiller.com?>
<link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=157db89f7134ddf0110519d6a7f4a1e8" charset="UTF-8" async></script>
<? // Add Kuznetsov S.A. 2017-10-18 End callbackkiller.com ?>

<? /*<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-89084511-1', 'auto');
  ga('send', 'pageview');
</script> */ //Commented Kuznetsov S.A. 2017-10-11 ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter39719355 = new Ya.Metrika2({
                    id:39719355,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39719355" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Google Analytics -->
<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');



ga('create', 'UA-107061801-1', 'auto');

ga('send', 'pageview');

</script>

			<script>
		//$('.one-click-buy').prop('disabled', true);
		/*$('.one-click-buy').css('opacity', '0.5');
		$('.one-click-buy').append("<div class='button-preload' style='width: 100%; height: 100%; position: absolute; top: 0; left: 0;background: url(http://hello-site.ru//main/images/preloads/spinning-circles.svg) center center no-repeat;background-size:20px;'></div>");*/
		window.onload = function() {
			//setTimeout("$('.one-click-buy').prop('disabled', false)", 1000);
			/*$('.one-click-buy').css('opacity', '1');
			$('.button-preload').remove();*/
		};
	</script>


<!-- End Google Analytics -->


</nofollow></noindex>
<script>
	$(window).on('scroll', function(){
		//console.log($("#header-scroll").offset().top);
		if ($("#header-scroll").offset().top > -20) {
			$('#basket').addClass('stic');
		}
		else $('#basket').removeClass('stic');
	});
	$('.buy').on('click', function(){
		console.log($('#basket .flaticon-shopping109'));
		$('#basket .flaticon-shopping109').removeClass('p4');
		$('#basket .flaticon-shopping109').addClass('p1');
		setTimeout(function(){
			$('#basket .flaticon-shopping109').removeClass('p1');
			$('#basket .flaticon-shopping109').addClass('p2');
			setTimeout(function(){
				$('#basket .flaticon-shopping109').removeClass('p2');
				$('#basket .flaticon-shopping109').addClass('p3');
				setTimeout(function(){
					$('#basket .flaticon-shopping109').removeClass('p3');
					$('#basket .flaticon-shopping109').addClass('p2');
					setTimeout(function(){
						$('#basket .flaticon-shopping109').removeClass('p2');
						$('#basket .flaticon-shopping109').addClass('p3');
						setTimeout(function(){
							$('#basket .flaticon-shopping109').removeClass('p3');
							$('#basket .flaticon-shopping109').addClass('p2');
							setTimeout(function(){
								$('#basket .flaticon-shopping109').removeClass('p2');
								$('#basket .flaticon-shopping109').addClass('p3');
								setTimeout(function(){
									$('#basket .flaticon-shopping109').removeClass('p3');
									$('#basket .flaticon-shopping109').addClass('p2');
									setTimeout(function(){
										$('#basket .flaticon-shopping109').removeClass('p2');
										$('#basket .flaticon-shopping109').addClass('p4');
									}, 100);	
								}, 100);
							}, 100);
						}, 100);
					}, 100);
				}, 100);
			setTimeout(function(){}, 100);
			}, 100);
		}, 100);
	});
</script>
<style type="text/css">
	#catalog-at-top.fixed {
		top: 120px !important;
	}
	#header-scroll.fixed {
		top: -20px !important;
	}
	.stic {
		position: fixed !important;
		right: 0px !important;
		top: 250px !important;
	}
	.stic .text-content, .stic .text-info {
		display: none !important;
	}
	.stic>a {
		background: #7aa188;
		box-shadow: inset 0px -2px 0px #7aa188;
	}
	.stic .flaticon-shopping109::before {
		top: 0px !important;
	}
	.stic .flaticon-shopping109 {
		float: left;
	}
	.p1::before {
		transform: rotate(-3deg);
		transition: ease-out .1s;
	}
	.p2::before {
		transform: rotate(6deg);
		transition: ease-out .1s;
	}
	.p3::before {
		transform: rotate(-6deg);
		transition: ease-out .1s;
	}
	.p4::before {
		transform: rotate(3deg);
		transition: ease-out .1s;
	}
</style>
</body>
</html>