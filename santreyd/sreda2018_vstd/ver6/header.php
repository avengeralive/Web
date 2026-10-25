<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
global $USER;
?><!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?=SITE_TEMPLATE_PATH?>/apple_fav.png">
    <meta name="application-name" content="<?=SITE_NAME?>">
    <?
    use Bitrix\Main\Page\Asset;
    Asset::getInstance()->addString('<link rel="icon" sizes="16x16 32x32" type="image/png" href="'.SITE_TEMPLATE_PATH.'/apple_fav.png">');
    Asset::getInstance()->addString('<link rel="shortcut icon" sizes="16x16 32x32" type="image/x-icon" href="'.SITE_TEMPLATE_PATH.'/favicon.ico">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon-precomposed" sizes="152x152 144x144 120x120 114x114 72x72" href="'.SITE_TEMPLATE_PATH.'/apple_fav.png">');
    ?>
    
    <link href="/local/templates/sreda2018_vstd/css/style__site.css" type="text/css" rel="stylesheet">
    <link href="/local/templates/sreda2018_vstd/css/add.css" type="text/css" rel="stylesheet">
    <link href="/local/templates/sreda2018_vstd/css/swiper.css" type="text/css" rel="stylesheet">
    <link href="/local/templates/sreda2018_vstd/css/nouislider.css" type="text/css" rel="stylesheet">
    <link href="/local/templates/sreda2018_vstd/css/nouislider.pips.css" type="text/css" rel="stylesheet">
    <link href="/local/templates/sreda2018_vstd/css/app.css" type="text/css" rel="stylesheet">
    
    <link href="/local/templates/sreda2018_vstd/css/style.css" type="text/css" rel="stylesheet">
    <link href="/local/templates/sreda2018_vstd/css/style.home.css" type="text/css" rel="stylesheet">

    <link href="/local/templates/sreda2018_vstd/css/respons_headerfooter.css" type="text/css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET;?>" />
    <title><?$APPLICATION->ShowTitle();?></title>
    <?
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowMeta("keywords");
    $APPLICATION->ShowMeta("description");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();

    ?>

    <meta name="google-site-verification" content="ti0J8OEhwQoxBvu8RPRCo7NT7EiDgxMwQjP9_7ANKCk" />
    <meta name="google-site-verification" content="F42rkoONTlGnOIU2A-t_RNbJqmTXKjkBNWcaqWv6cQU" />

    <!-- Yandex.Metrika counter --> 
    <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter50372446 = new Ya.Metrika2({ id:50372446, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script>
    <meta name="google-site-verification" content="RfkpwCfIgDo_lFFi-uhya27iCBO4EvOXIj6hQmihhjM" />
    <meta name="yandex-verification" content="f0fa3d3ddae4bd4f" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126169826-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-126169826-1');
    </script>
</head>
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
</script>
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

<header class="header_new">
    <div itemscope="" itemtype="http://schema.org/Organization" class="page-content">
        <meta itemprop="name" content="Сантрейд">
        <meta itemprop="telephone" content="+74959843875">
        <meta itemprop="telephone" content="88007751859">
        <meta itemprop="email" content="salonsreda@yandex.ru">
        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress" style="position: absolute; left: 9999999px; top: -999999px;">
            <meta itemprop="streetAddress" content="Андроновское шоссе, д. 26, бизнес-центр «Персона Грата», корп.5, этаж 6">
            <meta itemprop="postalCode" content="1111024">
            <meta itemprop="addressLocality" content="Москва">
        </div>
        <div class="header-content">
            <div class="content-block">
                <div class="header_new--brand">
                    <div class="col-left-content">
                        <p class="site-logo-block">
                            <a href="/">
                                <img src="/local/templates/sreda2018_vstd/images/site-logo.png" alt="Сантрейд импорт">
                            </a>
                        </p>
                        <div class="subheader">ТЕРРИТОРИЯ КОМФОРТНОГО ПРОСТРАНСТВА</div>
                    </div>
                </div>
                <div class="header_new--right">
                    <div class="header_new--right__t">
                        <div class="header_new--right__top-wrap">
                            <div class="header_new__top-region header_new--right__top-link no-mobile">
                                Ваш регион: <span class="header_new__top-region-item">Москва</span>
                            </div>
                            <div class="header_new__top-shipping header_new--right__top-link no-mobile">
                            <span class="top-icon">
                                <svg aria-hidden="true" data-prefix="fas" data-icon="truck" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-truck fa-w-20 fa-3x"><path fill="currentColor" d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z" class=""></path></svg>
                            </span>
                                Бесплатная доставка</div>
                            <div class="header_new__top-favorite header_new--right__top-link">
                                <span class="top-icon">
                                <svg aria-hidden="true" data-prefix="fas" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-heart fa-w-16 fa-3x"><path fill="currentColor" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z" class=""></path></svg>
                                </span>
                                <span class="text">Добавлен 1 товар</span>
                            </div>

                            <div class="header_new__top-basket header_new--right__top-link">
                                <span class="top-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.5 49.5"><g id="e3a4fd4e-f2ab-450a-8b71-45877b4e5b49" data-name="Layer 2"><g id="5177fe22-6232-47fd-91ef-5a97b65b5750" data-name="Слой 1"><path d="M38.9,20.1v-.2a1,1,0,0,0-1-1H32.1l-.3-4.2a.37.37,0,0,0-.1-.3,3.9,3.9,0,0,0-.6-1.1,1.07,1.07,0,0,0-.3-.5,6.79,6.79,0,0,0-5.1-2.9H24.6a6.63,6.63,0,0,0-5.1,2.9.7.7,0,0,0-.4.5,3.88,3.88,0,0,0-.6,1.1.37.37,0,0,0-.1.3l-.2,4.2H12.3a1.08,1.08,0,0,0-.7.3.91.91,0,0,0-.3.7v.2h0a1.33,1.33,0,0,0-.3.8v11c0,.2.1.3.1.5a12.56,12.56,0,0,0,4.2,4.5c.1.2.3.2.5.2H34.3c.3,0,.5,0,.6-.2a12.57,12.57,0,0,0,4.2-4.5.9.9,0,0,0,.1-.5v-11A1.33,1.33,0,0,0,38.9,20.1Zm-18-5.9.1-.1a4.6,4.6,0,0,1,3.7-2.2h.9a4.75,4.75,0,0,1,3.7,2.2v.1c0,.1,0,.1.1.2s.3.4.4.6l.3,3.9H20.2l.2-3.9a6,6,0,0,0,.4-.6C20.8,14.3,20.8,14.3,20.9,14.2Zm16.3,6.7V31.6a9.27,9.27,0,0,1-3.1,3.5H16.2A10.55,10.55,0,0,1,13,31.6V20.9h5.1l-.3,4.7a1,1,0,0,0,.4.8c.1.2.4.2.6.2a1.2,1.2,0,0,0,.8-.2,1,1,0,0,0,.2-.7l.3-4.8H30.2l.1,4.8a.87.87,0,0,0,.4.7c.1.2.4.2.7.2a.84.84,0,0,0,.7-.2,1.2,1.2,0,0,0,.2-.8l-.1-4.7Z" style="fill:#fff"/></g></g></svg>
                                </span>
                                <span class="text">В корзине 1 товар</span>

                            </div>
                            <div class="header_new--right__top-link header_new--right__top-email">
                                <a class="email" href="mailto:infosalonsreda@yandex.ru">infosalonsreda@yandex.ru</a>
                            </div>
                        </div>
                        <div class="header_new__top-account no-mobile">
                            <span>
                            <svg aria-hidden="true" data-prefix="far" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-user fa-w-14 fa-3x"><path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" class=""></path></svg>
                            </span>
                            <div class="header_new__top-account-wrap-link">
                                <a class="email" href="/personal/profile/">Войти</a> | <a class="email" href="/personal/profile/?register=yes">Регистрация</a>
                            </div>
                        </div>
                        <div class="is-mobile-header">
                            <div class="is-mobile-header__account">
                                <span>
                            <svg aria-hidden="true" data-prefix="far" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-user fa-w-14 fa-3x"><path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" class=""></path></svg>
                            </span>
                            </div>
                            <div id="burger_menu" title="Меню" class="burger-icon">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </div>
                        </div>
                    </div>
                    <div class="header_new--right__second-line">
                        <div class="header_new--right__menu">
                            <ul class="header_new--right__menu-wrap">
                                <li class=""><a href="/" title="Главная">Главная</a></li>
                                <li class=""><a href="/catalog" title="Каталог">Каталог</a></li>
                                <li class=""><a href="/brands" title="Бренды">Бренды</a></li>
                                <li class=""><a href="#" title="Подбор товара">Подбор товара</a></li>
                                <li class=""><a href="/infopage/dizaynery/" title="Дизайнеры">Дизайнеры</a></li>
                                <li class=""><a href="/news/" title="Новости">Новости</a></li>
                                <li class=""><a href="/about/" title="О нас">О нас</a></li>
                                <li class=""><a href="#" title="Доставка">Доставка</a></li>
                                <li class=""><a href="/about/contacty/" title="Контакты">Контакты</a></li>
                                <li class="sale_link"><a href="#" title="Распродажа">Распродажа</a></li>
                            </ul>
                            <div class="phone_block">
                                <a href="tel:+74959843875">+7-495-984-38-75</a>
                                <a href="tel:+78007751859" class="right_phone">+7-800-775-18-59</a>
                                <span>по России бесплатно</span>
                                <a class="is-mobile-mail" href="mailto:infosalonsreda@yandex.ru">infosalonsreda@yandex.ru</a>
                            </div>
                        </div>
                        <div class="search-block">
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
                </div>
            </div>
        </div>
    </div>
</header>
<section class="wrapper">
    <div class="layer">
        <div class=" layer-inner">
            <div class="page layer-menu">
                <div class="layer-menu-line">
                    <div class="layer-menu-block">
                        <h2>Сантехника</h2>
                        <a href="../catalog.html">Душевые кабины и углы</a>
                        <a href="../catalog.html">Ванны</a>
                        <a href="../catalog.html">Унитазы</a>
                        <a href="../catalog.html">Раковины</a>
                        <a href="../catalog.html">Кухонные мойки</a>
                        <a href="../catalog.html">Смесители</a>
                        <a href="../catalog.html">Душевая программа</a>
                        <a href="../catalog.html">Биде</a>
                        <a href="../catalog.html">Писсуары</a>
                        <a href="../catalog.html">Инсталляция</a>
                        <a href="../catalog.html">Сифоны</a>
                        <a href="../catalog.html">Трапы и душевые лотки</a>
                        <a href="../catalog.html">Аксессуары</a>
                        <a href="../catalog.html">Полотенцесушители</a>
                        <a href="../catalog.html">Водонагреватели</a>
                        <a href="../catalog.html">Радиаторы отопления</a>
                        <a href="../catalog.html">Обогреватели</a>
                        <a href="../catalog.html">Котлы отопления</a>
                        <a href="../catalog.html">Тепловые котлы</a>
                        <a href="../catalog.html">Комплектующие</a>
                    </div>
                    <div class="layer-menu-block">
                        <h2>Мебель <br/>для ванной</h2>
                        <a href="#">Шкафы для раковины</a>
                        <a href="#">Хранение в ванной</a>
                        <a href="#">Зеркала для ванной</a>
                        <a href="#">Текстиль для ванной</a>
                        <a href="#">Аксессуары для ванной</a>
                        <a href="#">Освещение в ванной</a>
                    </div>
                </div>
                <div class="layer-menu-line">
                    <div class="layer-menu-block">
                        <h2>Гостиная</h2>
                        <a href="#">Диваны и кресла</a>
                        <a href="#">Столы</a>
                        <a href="#">Шкафы</a>
                        <a href="#">Комоды</a>
                        <a href="#">Мебель для ТВ и мультимедиа</a>
                        <a href="#">Решения для хранения в гостиной </a>
                        <a href="#">Журнальные и приставные столы</a>
                        <a href="#">Библиотеки</a>
                        <a href="#">Освещение</a>
                        <a href="#">Зеркала</a>
                        <a href="#">Текстиль для гостиной </a>
                        <a href="#">Ручки мебельные</a>
                        <a href="#">Аксессуары для дома</a>
                    </div>
                    <div class="layer-menu-block">
                        <h2>Кухня</h2>
                        <a href="#">Комплекты</a>
                        <a href="#">Столы</a>
                        <a href="#">Стулья</a>
                        <a href="#">Шкафы</a>
                    </div>
                    <div class="layer-menu-block">
                        <h2>Спальня</h2>
                        <a href="#">Кровати</a>
                        <a href="#">Шкафы</a>
                        <a href="#">Зеркала</a>
                        <a href="#">Освещение</a>
                        <a href="#">Текстиль</a>
                        <a href="#">Аксессуары</a>
                    </div>
                </div>
                <div class="layer-menu-line">
                    <div class="layer-menu-block">
                        <h2>Детская</h2>
                        <a href="#">Комплекты</a>
                        <a href="#">Кровати</a>
                        <a href="#">Аксессуары</a>
                    </div>
                    <div class="layer-menu-block">
                        <h2>Офис</h2>
                        <a href="#">Шкафы</a>
                        <a href="#">Столы</a>
                        <a href="#">Кресла и стулья</a>
                        <a href="#">Освещение</a>
                    </div>
                    <div class="layer-menu-block">
                        <h2>Прихожая</h2>
                        <a href="#">Шкафы</a>
                        <a href="#">Полки</a>
                        <a href="#">Освещение в прихожей </a>
                        <a href="#">Зеркала</a>
                        <a href="#">Табуреты и скамьи</a>
                        <a href="#">Аксессуары</a>
                    </div>
                </div>
                <div class="layer-menu-line">
                    <div class="layer-menu-block">
                        <h2>Освещение</h2>
                        <a href="#">Светодиодное освещение</a>
                        <a href="#">Ночные лампы</a>
                        <a href="#">Потолочное освещение</a>
                        <a href="#">Абажуры и основания</a>
                        <a href="#">Рабочие лампы</a>
                        <a href="#">Торшеры</a>
                        <a href="#">Встроенная подсветка</a>
                        <a href="#">Софиты</a>
                        <a href="#">Бра</a>
                        <a href="#">Освещение для детской</a>
                        <a href="#">Декоративное освещение</a>
                        <a href="#">Наружное освещение</a>
                        <a href="#">Освещение ванной</a>
                    </div>
                    <div class="layer-menu-block">
                        <h2>Другое</h2>
                        <a href="#">Отделочные материалы</a>
                        <a href="#">Уличная мебель</a>
                        <a href="#">Барные стулья</a>
                        <a href="#">Бары</a>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="close a"></div>
            </div>
        </div>
    </div>
    <div class="page">