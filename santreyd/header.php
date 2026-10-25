<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

IncludeTemplateLangFile(__FILE__);

global $USER;

$brand_selector_raw = $_SERVER['REQUEST_URI']; // получим ссылку на страницу
$contacts_check = substr($brand_selector_raw, 0, 5); // возьмем первые 5 символов
if ($contacts_check == '/info') { // если это info, то
    $marker_cont = stripos($brand_selector_raw, "contacts/"); // создадим маркер позиции contact/....
    $brand_selector = substr($brand_selector_raw, 5, $marker_cont - 5); // обрежем от ссылки /info и все что после contact/ - в итоге получим название бренда
    $title_href = 'https://santreyd.ru/brands' . $brand_selector; // соберем ссылку, где есть нужный нам title
    $content = file_get_contents($title_href); // вытащим title с этой страницы
    preg_match_all('#<title>.+</title>#', $content, $matches);
    $newtitle = preg_replace('#(<title>|</title>)#', '', $matches[0][0]); // здесь удаляем <title> и </title>
    $marker_for_title = true;
} else {
    $marker_for_title = false;
}

$canonialrelraw = $_SERVER['REQUEST_URI']; // получим ссылку на страницу
$marker_pagen = 0; // создадим маркер для обрезки pagen
$canonialpart1 = '<link rel="canonical" href="http://santreyd.ru';
$canonialpart3 = '" />';
$marker_pagen = stripos($canonialrelraw, "?PAGEN"); // зададим ему местоположение pagen
if ($marker_pagen != 0) { // если маркер != 0, то удалим pagen всё что после него
    $canonialrelraw = substr($canonialrelraw, 0, $marker_pagen);
}
$catalog_check = substr($_SERVER['REQUEST_URI'], 0, 8); // возьмем первые 5 символов
if ($catalog_check != '/catalog' || $marker_pagen != 0) {
    $canonial_final = $canonialpart1 . $canonialrelraw . $canonialpart3;
}
?><!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>" >
<head>
    <!-- /sreda2018/header -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?/*<meta name="viewport" content="width=device-width">*/?>

    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?=SITE_TEMPLATE_PATH?>/apple_fav.png">
    <meta name="application-name" content="<?=SITE_NAME?>">
    <?
    use Bitrix\Main\Page\Asset;
    Asset::getInstance()->addString('<link rel="icon" sizes="16x16 32x32" type="image/png" href="'.SITE_TEMPLATE_PATH.'/apple_fav.png">');
    Asset::getInstance()->addString('<link rel="shortcut icon" sizes="16x16 32x32" type="image/x-icon" href="'.SITE_TEMPLATE_PATH.'/favicon.ico">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon-precomposed" sizes="152x152 144x144 120x120 114x114 72x72" href="'.SITE_TEMPLATE_PATH.'/apple_fav.png">');
    // старые стили для совместимости с контентом внутренних страниц
    $APPLICATION->AddHeadScript('/local/templates/sreda_adaptive/js/swiper.min.js');
    if ($APPLICATION->GetCurPage(false) !== '/') {
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/swiper.css');
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/product_style.css');
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/js/jquery.formstyler.css');
        // Asset::getInstance()->addCss('//fonts.googleapis.com/css?family=PT+Sans:400,700');
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/app.css');
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/add.css');
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/js/sliders/assets/owl.carousel.css');
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/adaptive.css');
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/add2.css');
	    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/add3.css');
    }
    // ******************** старые стили конец
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/app.css');
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/adaptive.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/js/jquery.fancybox.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/stylesheets/css/app.autoprefixer.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/stylesheets/psadd.css');
    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/media-queries.css');
    ?>

    <meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET;?>" />
    <title><?php if ($marker_for_title) {
            echo $newtitle;
        } else {
            $APPLICATION->ShowTitle();
        } ?></title>
    <?
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/dom.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/mask.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/swiper.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.pack.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.formstyler.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/modernizr.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/addtocopy.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/script.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/add.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/sliders/owl.carousel.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/fav.js');
    $APPLICATION->ShowMeta("robots");
	$APPLICATION->ShowMeta("keywords");
	$APPLICATION->ShowMeta("description");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();

    if (!$USER->isAdmin()){ ?>

    <style>
        body{opacity:0.01}
    </style>
    <? }

    if ($APPLICATION->GetCurPage(false) === '/') {
	    $speed = COption::GetOptionString( "askaron.settings", "UF_SLICK_SPEED" )*1000;
	    if (!$speed) {
            $speed = 3000;
        }
    ?>

    <script>
        ;$(document).ready(function() {
	        $('.bchoice-slider').slick({
                dots: true,
                arrows: false,
                infinite: false,
                autoplay: true,
                autoplaySpeed: <?=$speed?>,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 3,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
    <? } ?>

    <meta name="google-site-verification" content="ti0J8OEhwQoxBvu8RPRCo7NT7EiDgxMwQjP9_7ANKCk" />
    <meta name="google-site-verification" content="F42rkoONTlGnOIU2A-t_RNbJqmTXKjkBNWcaqWv6cQU" />


<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter50372446 = new Ya.Metrika2({ id:50372446, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/50372446" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter --></head>
<meta name="google-site-verification" content="RfkpwCfIgDo_lFFi-uhya27iCBO4EvOXIj6hQmihhjM" />
<meta name="yandex-verification" content="f0fa3d3ddae4bd4f" />
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126169826-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-126169826-1');
</script>


<?
$class = '';
if($APPLICATION->GetCurPage(false) !== '/') {
    $class = ' class="inner"';
}
?>
<body<?=$class?><?if (!$USER->IsAuthorized()){?> <?}?>>
<!-- Rating@Mail.ru counter -->
<script >
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "2545316", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div>
<img src="//top-fwz1.mail.ru/counter?id=2545316;js=na" style="border:0;position:absolute;left:-9999px;" alt="" />
</div></noscript>
<!-- //Rating@Mail.ru counter -->

<?php include_once("analyticstracking.php") ?>
<?
// if ($USER->IsAdmin())
$arGroups = $USER->GetUserGroupArray();
$arPanelGroups = array(1,8,10,11,12,6,7);
$resArr = array_intersect($arGroups,$arPanelGroups);
if(is_array($resArr) && count($resArr)){
	$APPLICATION->ShowPanel();
}	
?>
	
    <div class="fixed-header">
      <div class="grid-container">
        <div class="grid-x">
          <div class="small-8 col-lg-5 col-xl-4 cell">
            <a href="/" class="fixed-header-logo"></a>
            
            <div class="fixed-header-butter" data-toggle="site-reveal-menu" aria-controls="site-reveal-menu" aria-haspopup="true">
              <div class="line"></div>
              <div class="line"></div>
              <div class="line"></div>
            </div>

            <div class="fixed-header-phones">
              <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/includes/phone.php", Array(), Array("MODE"=>'php', "SHOW_BORDER"=>true));?>
            </div>

            <div class="fixed-header-contact">
              <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/includes/phone4mobile.php", Array(), Array("MODE"=>'php', "SHOW_BORDER"=>true));?>
            </div>
          </div>
 
          <div class="col-lg-4 col-xl-4 cell text-center d-lg-none">
<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"fixed",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"NUM_CATEGORIES" => "0",
		"TOP_COUNT" => "5",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"CATEGORY_0_TITLE" => "Каталог",
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "2",
		)
	),
	false
);?>          </div>

          <div class="small-4 col-lg-3 col-xl-4 cell">
           <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "sreda2018_fixed", Array(
	"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_EMPTY_VALUES" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRODUCTS" => "N",
		"SHOW_TOTAL_PRICE" => "N",
	),
	false
);?>     

            <a href="/personal/favourite/" class="fixed-header-favourite">
              <span class="text">избранное</span>
              <span class="count"></span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <header class="header">
      <div itemscope itemtype="http://schema.org/Organization" class="page-content">
		  <meta itemprop="name" content="Сантрейд">
		  <meta itemprop="telephone" content="+74959843875">
		  <meta itemprop="telephone" content="88007751859">
		  <meta itemprop="email" content="salonsreda@yandex.ru">
		  <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" style="position: absolute; left: 9999999px; top: -999999px;">
		  <meta itemprop="streetAddress" content="Андроновское шоссе, д. 26, бизнес-центр «Персона Грата», корп.5, этаж 6">
		  <meta itemprop="postalCode" content="1111024">
		  <meta itemprop="addressLocality" content="Москва">
		  </div>
        <div class="header-content">
          <div class="content-block">
            <div class="col-left">
              <div class="col-left-content">
                <p class="site-logo-block" style="text-align: center;">
                  <a href="/">
               <img src="/site-logo.png" alt="Среда обитания">
                  </a>
                </p>

                <div class="subheader">ТЕРРИТОРИЯ КОМФОРТНОГО ПРОСТРАНСТВА</div>
              </div>
            </div><!--

           --><div class="col-right">
              <div class="icons-menu-container">
                <div class="icons-block">
                  <ul class="icons-menu">
                    <li class="js-favorite">
                        <a href="/personal/favourite/">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-fav.svg" alt="">
                        </a>
                        <div class="items-counter">0</div>
						<div id="favourite-body">
                            <div id="favourite-jdata">null</div>
		                </div>
                    </li>
                    <li><a href="/personal/"><img src="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-user.svg" alt=""></a></li>
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "sreda2018", Array(
	"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_EMPTY_VALUES" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRODUCTS" => "N",
		"SHOW_TOTAL_PRICE" => "N",
	),
	false
);?>                  </ul>
                  <a class="email"><h1 class="section-title"><?=COption::GetOptionString("askaron.settings", "UF_POP_TITLE" )?></h1></a>
                </div>

                <div class="phone-block">
                <div>
<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/includes/phone.php", Array(), Array("MODE"=>'php', "SHOW_BORDER"=>true));?>								
                </div>

                <div class="call-info"></div>
                <a class="email" href="mailto:salonsreda@yandex.ru"><?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/includes/email.php", Array(), Array("MODE"=>'php', "SHOW_BORDER"=>true));?><?//$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/includes/email.php", Array(), Array("MODE"=>'php', "SHOW_BORDER"=>true));?></a>
              </div>
              </div><!--

        --><div class="menu-block">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"vertical",
	array(
		"ROOT_MENU_TYPE" => "vert",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "36000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"COMPONENT_TEMPLATE" => "vertical"
	),
	false
);?>
                </div>

            </div>
          </div>
          <div class="search-block">
            <div class="hamburger hamburger-css" data-toggle="site-reveal-menu"><p class="hamburger-p">Меню</p></div>
<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"NUM_CATEGORIES" => "0",
		"TOP_COUNT" => "5",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input2",
		"CONTAINER_ID" => "title-search",
		"CATEGORY_0_TITLE" => "Каталог",
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "2",
		)
	),
	false
);?>
          </div>

        </div>
<?
$pic = CFile::GetPath(COption::GetOptionString("askaron.settings", "UF_HPROMO_PICTURE"));
$url = COption::GetOptionString("askaron.settings", "UF_PROMO_URL");
$alt = COption::GetOptionString("askaron.settings", "UF_PROMO_ALT");
$title = COption::GetOptionString("askaron.settings", "UF_PROMO_TITLE");
if($url){
?>
        <!--noindex--><!--googleoff:index--><!--<a class="header-promo" href="<?//=$url?>" title="<?//=$title?>"><img src="<?//=$pic?>" alt="<?//=$alt?>" /></a>--><!--googleon:index--><!--/noindex-->
<?}
else{?>
        <!--noindex--><!--googleoff:index--><!--<div class="header-promo"><img src="<?//=$pic?>" alt="<?//=$alt?>" title="<?//=$title?>" /></div>--><!--googleon:index--><!--/noindex-->
<?}?>
      </div>



<script>
$(document).ready(function(){
	$('.header-promo-fixed-mobile span').click(function(){
		$(this).next().slideToggle(100);
	});
	setInterval(function(){
		if($('html, body').scrollTop() > 300)
			$('.header-promo-fixed-mobile').css('top', 80);
		else
			$('.header-promo-fixed-mobile').css('top', 10);
	},200);
});
</script>	
		
    </header>
    <section class="hero">
<?if($APPLICATION->GetCurPage(false) === '/'){?>


<?
$APPLICATION->IncludeComponent(
	"ps:ps.home_slider2", 
	".default", 
	array(
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "A",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_ORDER" => "asc",
		"IBLOCK_ID" => "32",
		"IBLOCK_TYPE" => "home",
		"COMPONENT_TEMPLATE" => ".default",
		"SPEC_URL" => "/about/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"OPTIMISED" => "N"
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
	"ps:ps.socnets", 
	".default", 
	array(
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "33",
		"IBLOCK_TYPE" => "home",
		"COMPONENT_TEMPLATE" => ".default",
		"MARGIN_RIGHT" => "5",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
<?}?>
    </section>

    <?
    global $USER;
    if (!$USER->isAdmin()) { ?>
        <!-- BEGIN JIVOSITE CODE {literal} -->
        <script type='text/javascript'>
            (function(){ var widget_id = 'WCChfMlUqq';var d=document;var w=window;function l(){
                var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('оnload',l);}else{w.addEventListener('load',l,false);}}})();</script>
        <!-- {/literal} END JIVOSITE CODE -->
    <? } ?>

<?if($APPLICATION->GetCurPage(false) !== '/' || strpos($APPLICATION->GetCurPage(false),'/blog/') !== false){?>
  <div class="page-content">
<?}?>