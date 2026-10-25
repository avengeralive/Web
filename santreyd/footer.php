<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!-- sreda2018/footer -->
<? if ($APPLICATION->GetCurPage(false) !== '/') { ?>
    </div>
<? } ?>
<footer>
    <div class="page" style="background-color: #fff;">
        <div class="footer_search_block_css">
            <? $APPLICATION->IncludeComponent(
                "bitrix:search.title",
                ".defaultfooter",
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
                    "INPUT_ID" => "title-search-input-footer",
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
            ); ?>
        </div>
        <script>
            $(document).ready(function () {
                var height1 = $('.footer-block-p-js-1').height();
                var height2 = $('.footer-block-p-js-2').height();
                var height3 = $('.footer-block-p-js-3').height();
                if (height1 >= height2 && height1 >= height3) {
                    var set_height = height1
                }
                if (height2 >= height1 && height2 >= height3) {
                    var set_height = height2
                }
                if (height3 >= height1 && height3 >= height2) {
                    var set_height = height3
                }
                var height1 = $('.footer-block-p-js-1').height(set_height);
                var height2 = $('.footer-block-p-js-2').height(set_height);
                var height3 = $('.footer-block-p-js-3').height(set_height);
            });
        </script>
        <? $APPLICATION->IncludeFile("/local/templates/sreda_adaptive/includes/footer_box.php", Array(), Array("MODE" => 'php', "SHOW_BORDER" => true)); ?>
    </div>
</footer>
<!-- START menu modal window -->
<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "full_catalog",
    array(
        "ROOT_MENU_TYPE" => "catalog",
        "MENU_CACHE_TYPE" => "Y",
        "MENU_CACHE_TIME" => "36000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(),
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "catalog",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "Y",
        "COMPONENT_TEMPLATE" => "full_catalog"
    ),
    false,
    array(
        "ACTIVE_COMPONENT" => "Y"
    )
); ?>
<!-- END menu modal window -->

<div style="display:none;">
    <!--LiveInternet counter-->
    <script>
        document.write("<a style='display:none;' href='http://www.liveinternet.ru/click' " +
            "target=_blank rel=nofollow><img src='//counter.yadro.ru/hit?t52.6;r" +
            escape(document.referrer) + ((typeof(screen) == "undefined") ? "" :
                ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
                screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
            ";" + Math.random() +
            "' alt='' title='LiveInternet: показано число просмотров за 24" +
            " часа, посетителей за 24 часа и за сегодня' " +
            "border='0' width='1' height='1'><\/a>")
    </script>
    <!--/LiveInternet-->

    <?
    //Боремся с хакерами накрутки статистики
    ?>
    <? $curDir = $APPLICATION->GetCurDir(); ?>
    <? if ($curDir != '/catalog/santehnika/aksessuary-dlya-vannoy/' && $curDir != '/catalog/santehnika/polotentsesushiteli-otoplenie/') { ?>
        <!-- Yandex.Metrika counter -->
        <!-- Yandex.Metrika counter -->
        <script>
            var yaParams = {ip_adress: "<? echo $_SERVER['REMOTE_ADDR'];?>"};
            //объявляем параметр ip_adress и записываем в него IP посетителя
        </script>
        <script>
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function () {
                    try {
                        w.yaCounter5155684 = new Ya.Metrika({
                            id: 5155684, params: window.yaParams,
                            webvisor: true,
                            clickmap: true,
                            accurateTrackBounce: true
                        });
                    } catch (e) {
                    }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () {
                        n.parentNode.insertBefore(s, n);
                    };
                s.type = "text/javascript";
                s.async = true;
                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript>
            <div><img src="//mc.yandex.ru/watch/5155684" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>
        <!-- /Yandex.Metrika counter -->
        <!-- /Yandex.Metrika counter -->
    <? } ?>
</div>


<style>
    .footer-block a {
        color: #0a0a0a;
    }

    .footer-block a:hover {
        color: white;
    }

    .footer-block {

    }

    .footer-block-1 {

    }

    .footer-block-2 {

    }

    .footer-block-3 {

    }

    .footer-block-4 {
        padding-left: 0;
    }

    .main-input {
        width: 255px;
        height: 45px;
        padding: 0 50px 0 15px;
        border-radius: 30px;
        box-sizing: border-box;
    }

    .footer-search {
        width: 41px;
        height: 38px;
        position: absolute;
        margin: auto;
        top: 4px;
        right: 2px;
    }

    .footer-block-4-td {
        width: 33.3%;
        text-align: center;
    }

    .footer-block-4-tr {

    }

    .footer-block-4-tbody {

    }

    .footer-block-4-table {
        width: 100%;
    }

    .footer-block-4-img {
        padding-top: 10px;
    }

    .footer-block-4-text {
        font: 600 20px/1.4 'arial';
        text-align: center;
        color: #3E3E40;
    }

    .footer_copyright_block_css {
        width: 100%;
        text-align: center;
        background-color: #fff;

    }

    .footer-ul {
    }

    .footer-li {
        list-style-type: none;
        line-height: 0.7;
    }

    .footer-li a {
        font-size: 1.3em;
        font: 400 20px/1.4 'arial';
    }

    .footer-li a:hover {
        color: #C2A15C;
    }

    .footer-li p {
        font-size: 1.3em;
        font: 600 20px/1.4 'arial';
        color: #3E3E40;
    }

    .footer-li-1st {
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .footer-block-text {
        padding: 0;
    }

    @media screen and (max-width: 1024px) {
        .footer_copyright_block_css {
            display: none;
        }

        .footer-block {
            height: auto !important;
        }

        .footer_search_block_css {
            display: none;
        }

        .footer-li p {
            font: 600 16px/1.4 'arial';
        }

        .footer-li a {
            font: 300 14px/0.1 'arial';
        }

        .footer-li-1st {
            margin-bottom: 0;
            margin-top: 20px;
        }

        .footer-block-1, .footer-block-2, .footer-block-3 {
            width: 33% !important;
            display: inline-block;
        }

        footer .page {
            background-color: #fff;
        }
    }

    .input-group-footer {
        margin-bottom: 0;
        margin-top: 30px;
    }

    #title-search-input-footer::-webkit-input-placeholder {
        color: #333;
        font-size: 24px;
        text-align: right;
        opacity: 1;
        font-weight: 600;
    }

    #title-search-input-footer::-moz-placeholder {
        color: #000;
        font-size: 24px;
        text-align: right;
        opacity: 1;
        font-weight: 600;
    }

    #title-search-input-footer:-ms-input-placeholder {
        color: #000;
        font-size: 24px;
        text-align: right;
        opacity: 1;
        font-weight: 600;
    }

    #title-search-input-footer::placeholder {
        color: #000;
        font-size: 24px;
        text-align: right;
        opacity: 1;
        font-weight: 600;
    }

    .button-footer-find {
        font-size: 24px !important;
        font-weight: 600;
        padding: 0px 80px;

    }

    #title-search-input-footer {
        padding: 1.5rem;
    }

    .copyright-p {
        text-align: center;
        overflow: hidden;
        margin: 0 20px;
    }

    .copyright-p::before, .copyright-p::after {
        content: "";
        position: relative;
        display: inline-block;
        width: 50%;
        height: 2px;
        vertical-align: middle;
        background: #000;
        background-clip: border-box;
        background-clip: content-box;
        border-bottom: 1px solid rgba(255, 255, 255, .5);
        left: -1.8em;
        margin: 0 0 0 -50%;
    }

    .copyright-p::after {
        left: 1.8em;
        margin: 0 -50% 0 0;
    }
</style>

<link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=891f5bd7d86c255990f0d37473a229e7" charset="UTF-8" async></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127969628-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127969628-1');
</script>
</body>

<?

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/assets/jquery.min.js');
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.fancybox.pack.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.formstyler.min.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/assets/slick.min.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/fav.js');
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/assets/script.min.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/index.min.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/psadd.js');

?>

</html>