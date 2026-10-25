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
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <!-- sreda_adaptive/header -->
    <meta http-equiv="Content-Type" content="text/html; charset=<?= LANG_CHARSET; ?>"/>
    <title><?php if ($marker_for_title) {
            echo $newtitle;
        } else {
            $APPLICATION->ShowTitle();
        } ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?= SITE_TEMPLATE_PATH ?>/apple_fav.png">
    <?= $canonial_final; ?>
    <meta name="application-name" content="<?= SITE_NAME ?>">
    <link rel="icon" sizes="16x16 32x32" type="image/png" href="<?= SITE_TEMPLATE_PATH ?>/apple_fav.png">
    <link rel="shortcut icon" sizes="16x16 32x32" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="152x152 144x144 120x120 114x114 72x72" href="<?= SITE_TEMPLATE_PATH ?>/apple_fav.png">
    <?php
    use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addString('<link rel="icon" sizes="16x16 32x32" type="image/png" href="' . SITE_TEMPLATE_PATH . '/apple_fav.png">');
    Asset::getInstance()->addString('<link rel="shortcut icon" sizes="16x16 32x32" type="image/x-icon" href="' . SITE_TEMPLATE_PATH . '/favicon.ico">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon-precomposed" sizes="152x152 144x144 120x120 114x114 72x72" href="' . SITE_TEMPLATE_PATH . '/apple_fav.png">');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/swiper.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/nouislider.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/jquery.formstyler.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/nouislider.pips.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style__site.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/sliders/assets/owl.carousel.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/app.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/add.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.css');

    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/adaptive.css');

    if ($APPLICATION->GetCurPage(false) == '/') {
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.home.css');
    }
    else {
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.catalog.css');
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.brands.css');
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.useful.css');
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.filter.css');
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.product.css');
    }

    
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/respons_headerfooter.css');


    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/stylesheets/css/app.autoprefixer.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/stylesheets/psadd.css');
    Asset::getInstance()->addCss('/local/templates/sreda_adaptive/css/media-queries.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/adaptive.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/media-queries.css");
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowMeta("keywords");
    $APPLICATION->ShowMeta("description");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/adaptive.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/media-queries.css");
?>
<meta name="google-site-verification" content="RfkpwCfIgDo_lFFi-uhya27iCBO4EvOXIj6hQmihhjM" />
<meta name="google-site-verification" content="ti0J8OEhwQoxBvu8RPRCo7NT7EiDgxMwQjP9_7ANKCk" />
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter50372446 = new Ya.Metrika2({ id:50372446, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/50372446" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<meta name="yandex-verification" content="f0fa3d3ddae4bd4f" />
<!-- Global site tag (gtag.js) - Google Analytics -->
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
                            <div class="header_new__top-favorite header_new--right__top-link ">
                                <a href="/personal/favourite/" style="display: flex;"><span class="top-icon">
                                <svg aria-hidden="true" data-prefix="fas" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-heart fa-w-16 fa-3x"><path fill="currentColor" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z" class=""></path></svg>
                                </span>
                                <span class="text">Избранное<!--Добавлен <span id="favourite-jdata"></span> товар</span>--></a>
                            </div>
                            <?php
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:sale.basket.basket.line",
                                            "sreda2018",
                                            array(
                                                "COMPOSITE_FRAME_MODE" => "A",
                                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                                "HIDE_ON_BASKET_PAGES" => "N",
                                                "PATH_TO_AUTHORIZE" => "",
                                                "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                                                "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                                                "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                                                "PATH_TO_REGISTER" => SITE_DIR . "login/",
                                                "POSITION_FIXED" => "N",
                                                "SHOW_AUTHOR" => "N",
                                                "SHOW_EMPTY_VALUES" => "N",
                                                "SHOW_NUM_PRODUCTS" => "Y",
                                                "SHOW_PERSONAL_LINK" => "N",
                                                "SHOW_PRODUCTS" => "N",
                                                "SHOW_TOTAL_PRICE" => "N",
                                            ),
                                            false
                                        );
                                        ?>
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
                                <li class=""><a href="/search" title="Подбор товара">Подбор товара</a></li>
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
                        <a href="/catalog/santehnika/aksessuary-dlya-vannoy/">Аксессуары </a>
                        <a href="/catalog/santehnika/bannye-kompleksy/">Банные комплексы </a>
                        <a href="/catalog/santehnika/basseyn-spa/">Бассейны </a>
                        <a href="/catalog/santehnika/bide/">Биде </a>
                        <a href="/catalog/santehnika/bani/">Бани </a>
                        <a href="/catalog/santehnika/vanna/">Ванны </a>
                        <a href="/catalog/santehnika/gidromassazhnaya-vanna/">Ванны гидромассажные </a>
                        <a href="/catalog/santehnika/dushevye-poddony/">Душевые поддоны </a>
                        <a href="/catalog/santehnika/dushevaya-kabina/">Душевые кабины </a>
                        <a href="/catalog/santehnika/dushevye-ugolki/">Душевые уголки </a>
                        <a href="/catalog/santehnika/zerkala-dlya-vannoy/">Зеркала </a>
                        <a href="/catalog/santehnika/installjacii/">Инсталляции </a>
                        <a href="/catalog/santehnika/ledogeneratory/">Ледогенераторы </a>
                        <a href="/catalog/santehnika/pissuary/">Писсуары </a>
                        <a href="/catalog/santehnika/parogenerator-dlya-hamama/">Парогенераторы </a>
                        <a href="/catalog/santehnika/polotentsesushiteli-otoplenie/">Полотенцесушители </a>
                        <a href="/catalog/santehnika/rakoviny/">Раковины</a>
                        <a href="/catalog/santehnika/sauna/">Сауны </a>
                        <a href="/catalog/santehnika/svetilniki-v-vannuyu/">Светильники </a>
                        <a href="/catalog/santehnika/dush/">Душевые лейки </a>
                        <a href="/catalog/santehnika/sushilki-dlya-ruk/">Сушилки для рук </a>
                        <a href="/catalog/santehnika/sideniya/">Сиденья табуреты </a>
                        <a href="/catalog/santehnika/smesiteli-dlya-bide/">Смесители для биде </a>
                        <a href="/catalog/santehnika/smesiteli-dlya-kukhni/">Смесители для кухни </a>
                        <a href="/catalog/santehnika/smesiteli-dlya-vannoy/">Смесители для ванной </a>
                        <a href="/catalog/santehnika/smesiteli-dlya-dusha/">Смесители для душа </a>
                        <a href="/catalog/santehnika/smesiteli/">Смесители для раковины </a>
                        <a href="/catalog/santehnika/gigienicheskiy-dush/">Смесители с гигиеническим душем </a>
                        <a href="/catalog/santehnika/tekstil-dlya-vannoy-komnaty/">Текстиль </a>
                        <a href="/catalog/santehnika/unitazy/">Унитаз </a>
                        <a href="/catalog/santehnika/hamam/">Хамам </a>
                        <a href="/catalog/santehnika/specialnaya-santehnika/">Специальная сантехника </a>
                        <a href="/catalog/santehnika/izlivy/">Изливы </a>
                    </div>
                    <div class="layer-menu-block">
                        <h2>Мебель <br/>для ванной</h2>
                        <a href="/catalog/mebel/mebel-dlya-vannoy-komnaty/">Мебель для ванной </a>
                        <a href="/catalog/mebel/aksessuary-dlya-doma/">Аксессуары для дома </a>
                        <a href="/catalog/mebel/komody/">Комоды </a>
                        <a href="/catalog/mebel/biblioteki/">Библиотеки </a>
                        <a href="/catalog/mebel/gostinye/">Гостиные </a>
                        <a href="/catalog/mebel/detskaya-mebel/">Детская мебель </a>
                        <a href="/catalog/mebel/divany-i-kresla/">Диваны и кресла </a>
                        <a href="/catalog/mebel/bary/">Домашний Бар </a>
                        <a href="/catalog/mebel/interernye-zerkala/">Интерьерные зеркала </a>
                        <a href="/catalog/mebel/mebel-dlya-kukhni/">Мебель для кухни </a>
                        <a href="/catalog/mebel/spalni/">Мебель для спальни </a>
                        <a href="/catalog/mebel/ruchki-mebelnye/">Ручки мебельные </a>
                        <a href="/catalog/mebel/skameyki/">Скамейки </a>
                        <a href="/catalog/mebel/stoly/">Столы </a>
                        <a href="/catalog/mebel/stulya1/">Стулья </a>
                        <a href="/catalog/mebel/taburety/">Табуреты </a>
                        <a href="/catalog/mebel/ulichnaya-mebel/">Уличная мебель </a>
                        <a href="/catalog/mebel/shkafy/">Шкафы </a>
                    </div>
                </div>
                <div class="layer-menu-line">
                    <div class="layer-menu-block">
                        <h2>Другое</h2>
                        <a href="/catalog/kaminy/aksessuary-dlya-kamina/">Аксессуары для камина </a>
                        <a href="/catalog/kaminy/biokamin/">Биокамины </a>
                        <a href="/catalog/kaminy/kamin-topka-prirodnym-gazom/">Камин топка природным газом </a>
                        <a href="/catalog/kaminy/kamin-topka-uglem/">Камин топка углем </a>
                        <a href="/catalog/kaminy/kamin-elektricheskiy/">Камин электрический </a>
                        <a href="/catalog/kaminy/kamin-drovyanoy/">Камины дровяные </a>
                        <a class="full_catalog_table_title" href="/catalog/kuhni/">КУХНИ</a>
                        <a href="/catalog/kuhni/aksessuary-dlya-kukhni/">Аксессуары для кухни </a>
                        <a href="/catalog/kuhni/kuhonnye-moyki/">Кухонные мойки </a>
                        <a href="/catalog/otdelochnye-materialy/bordyury/">Бордюры и плинтуса </a>
                        <a href="/catalog/otdelochnye-materialy/dekorativnye-panno-i-3d-paneli/">Декоративные панно и 3D панели </a>
                        <a href="/catalog/otdelochnye-materialy/iskusstvenny-kamen/">Искусственный камень </a>
                        <a href="/catalog/otdelochnye-materialy/mozaika/">Мозаика </a>
                        <a href="/catalog/otdelochnye-materialy/napolnye-pokrytiya/">Напольные покрытия </a>
                        <a href="/catalog/otdelochnye-materialy/parket-dla-vannoy/">Паркет </a>
                        <a href="/catalog/otdelochnye-materialy/plitka/">Плитка </a>
                        <a href="/catalog/otdelochnye-materialy/stenovie-paneli/">Стеновые панели </a>
                        <a href="/catalog/otdelochnye-materialy/freski/">Фрески </a>
                        <a href="/catalog/predmety-interera/vazy/">Вазы </a>
                        <a href="/catalog/predmety-interera/veshalki/">Вешалки </a>
                        <a href="/catalog/predmety-interera/zerkala/">Зеркала </a>
                        <a href="/catalog/predmety-interera/podsvechniki/">Подсвечники </a>
                        <a href="/catalog/predmety-interera/chasy/">Часы </a>
                        <a href="/catalog/predmety-interera/shkatulki/">Шкатулки </a>
                        <a href="/catalog/osveshenie/led/">LED </a>
                        <a href="/catalog/osveshenie/bolshie-lyustry/">Большие люстры </a>
                        <a href="/catalog/osveshenie/bra/">Бра </a>
                        <a href="/catalog/osveshenie/bra-i-nastennye/">Бра и настенные </a>
                        <a href="/catalog/osveshenie/lyustry/">Люстры </a>
                        <a href="/catalog/osveshenie/svetilniki/">Светильники </a>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="close a"></div>
            </div>
        </div>
    </div>
    <div class="page">