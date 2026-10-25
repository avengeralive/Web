<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Сантехника,Сантехника в Москве,официальный сайт сантехники,Мир сантехники,Лучшая Сантехника,Цены на сантехнику,сантехники оптом,сантрейд,сантрейд сантехника");
$APPLICATION->SetPageProperty("keywords_inner", "Сантехника,Сантехника в Москве,официальный сайт сантехники,Мир сантехники,Лучшая Сантехника,Цены на сантехнику,сантехники оптом,сантрейд, сантрейд сантехника");
$APPLICATION->SetPageProperty("keywords", "Сантехника, Сантехника в Москве, Официальный сайт сантехники");
$APPLICATION->SetPageProperty("description", "Интернет Магазин сантехники Сантрейд Импорт.РУ | 10 лет на рынке | Официальный поставщик с 2009 года | Сантехника из Италии Германии и Испании | Сотни брендов, тысячи коллекций | Сантехника для дома и офиса со склада и под заказ | Доставка по Москве и России | Оптовые цены! Работаем 24/7|");
$APPLICATION->SetPageProperty("title", "Сантехника Сантрейд");
$APPLICATION->SetTitle("Сантехника Сантрейд");
?>    <div class="page-content">
        <?
        $temp = '';
        $arFields = $USER_FIELD_MANAGER->GetUserFields("ASKARON_SETTINGS");
        $obEnum = new CUserFieldEnum;
        $rsEnum = $obEnum->GetList(array(), array("ID" => COption::GetOptionString("askaron.settings", "UF_POP_TEMPLATE")));
        if ($arEnum = $rsEnum->GetNext()) {
            $temp = $arEnum["VALUE"];
        }
        $APPLICATION->IncludeComponent("ps:ps.pop2", "={$temp}",
            Array(
                "BLOCK_TITLE" => COption::GetOptionString("askaron.settings", "UF_POP_TITLE"),
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => $temp,
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "30",
                "IBLOCK_TYPE" => "home",
                "OPTIMISED" => "N",
                "PAGE_ELEMENT_COUNT" => "7",
                "SECTION_ID" => "15124"
            )
        );
        $temp = '';
        $arFields = $USER_FIELD_MANAGER->GetUserFields("ASKARON_SETTINGS");
        $obEnum = new CUserFieldEnum;
        $rsEnum = $obEnum->GetList(array(), array("ID" => COption::GetOptionString("askaron.settings", "UF_POP2_TEMPLATE")));
        if ($arEnum = $rsEnum->GetNext()) {
            $temp = $arEnum["VALUE"];
        }
        $APPLICATION->IncludeComponent("ps:ps.pop2", "={$temp}",
            Array(
                "BLOCK_TITLE" => COption::GetOptionString("askaron.settings", "UF_POP2_TITLE"),
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => $temp,
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "30",
                "IBLOCK_TYPE" => "home",
                "OPTIMISED" => "N",
                "PAGE_ELEMENT_COUNT" => "5",
                "SECTION_ID" => "15127"
            )
        );
        ?>
    </div>
    <section class="bchoice">
        <h2 class="section-title">Выбор покупателей</h2>
        <?
        $APPLICATION->IncludeComponent("ps:ps.order.counter", "choice",
            Array(
                "CACHE_TIME" => "86400",
                "CACHE_TYPE" => "A"
            ),
            false,
            Array(
                'ACTIVE_COMPONENT' => 'Y'
            )
        );
        ?>
        <!-- START buyer's choice slider -->
        <?
        $APPLICATION->IncludeComponent("ps:ps.home_choice", "",
            Array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => ".default",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "34",
                "IBLOCK_TYPE" => "home",
                "PAGE_ELEMENT_COUNT" => "9"
            )
        );
        ?>
        <!-- END buyer's choice slider -->
        <?
        $APPLICATION->IncludeComponent("ps:ps.brands", "",
            Array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => "",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "35",
                "IBLOCK_TYPE" => "home",
                "PAGE_ELEMENT_COUNT" => "12"
            )
        );
        ?>
    </section>
    <div class="page-content">
        <section class="blog">
            <div class="h2 section-title">
                <a href="/blog/">Блог</a>
            </div>
            <?
            $APPLICATION->IncludeComponent("ps:ps.home_blogheader", ".default",
                Array(
                    "CACHE_TIME" => "86400",
                    "CACHE_TYPE" => "A",
                    "COMPONENT_TEMPLATE" => ".default",
                    "ELEMENT_SORT_FIELD" => "SORT",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "IBLOCK_ID" => "37",
                    "IBLOCK_TYPE" => "home"
                )
            );
            ?>
            <div class="grid-x grid-margin-x">
                <div class="cell xlarge-4">
                    <div class="h2 blog-list-title">Что нового</div>
                    <?
                    $APPLICATION->IncludeComponent("ps:ps.home_blognew", ".default",
                        Array(
                            "CACHE_TIME" => "86400",
                            "CACHE_TYPE" => "A",
                            "COMPONENT_TEMPLATE" => ".default",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO",
                            "ELEMENT_SORT_FIELD" => "SORT",
                            "ELEMENT_SORT_ORDER" => "asc",
                            "IBLOCK_ID" => "38",
                            "IBLOCK_TYPE" => "home",
                            "PAGE_ELEMENT_COUNT" => "5"
                        )
                    );
                    ?>
                </div>
                <!-- START blog slider -->
                <?
                $APPLICATION->IncludeComponent("ps:ps.home_blogslider", ".default",
                    Array(
                        "CACHE_TIME" => "86400",
                        "CACHE_TYPE" => "A",
                        "COMPONENT_TEMPLATE" => ".default",
                        "ELEMENT_SORT_FIELD" => "SORT",
                        "ELEMENT_SORT_ORDER" => "asc",
                        "IBLOCK_ID" => "36",
                        "IBLOCK_TYPE" => "home"
                    )
                );
                ?>
                <!-- END blog slider -->
            </div>
            <!-- START blog news grid -->
            <?
            $APPLICATION->IncludeComponent("ps:ps.home_newsblogs", ".default",
                Array(
                    "CACHE_TIME" => "86400",
                    "CACHE_TYPE" => "A",
                    "COMPONENT_TEMPLATE" => ".default",
                    "ELEMENT_SORT_FIELD" => "SORT",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "IBLOCK_ID" => "39",
                    "IBLOCK_TYPE" => "home",
                    "PAGE_ELEMENT_COUNT" => "3",
                    "SECTION_ID" => 15125
                )
            );
            ?>
            <!-- END blog news grid -->
        </section>
    </div>
    <section class="news">
        <div class="h2 section-title">
            <a href="/news/">Новости</a>
        </div>
        <?
        $APPLICATION->IncludeComponent("ps:ps.home_newsblogs", "news",
            Array(
                "CACHE_TIME" => "86400",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => "news",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "39",
                "IBLOCK_TYPE" => "home",
                "PAGE_ELEMENT_COUNT" => "9",
                "SECTION_ID" => 15126
            )
        );
        ?>
    </section>
<?
// $text = COption::GetOptionString("askaron.settings", "UF_HOME_PREFOOTEXT");
if ($text) {
?>
    <div class="page-content">
         <script>
             $(document).ready(function () {
                $('.prefotter_text').attr('data-hei', $('.prefotter_text').height());
                $('.prefooter_showmore span').click(function (e) {
                    if (!$('.prefotter_text').is(':animated')) {
                        var hei = <?=COption::GetOptionString("askaron.settings", "UF_HOME_PREFOOHEI")?>;
                        if ($('.js-open').is(':visible')) {
                            hei = $('.prefotter_text').data('hei');
                            $('.prefooter_showmore').animate({'bottom': '10px'}, 100);
                        } else {
                            $('.prefooter_showmore').animate({'bottom': 0}, 100);
                        }
                        $('.prefotter_text').animate({'height': hei}, 300, function () {
                            $('.prefotter_text').toggleClass('closed');
                            $('.js-open').toggle();
                            $('.js-close').toggle();
                        });
                    }
                });
                $('.prefooter_showmore span:first-child').click();
            });
        </script>
        <div class="prefooter_text_box">
            <div class="prefotter_text">
                <?= $text; ?>
            </div>
            <div class="prefooter_showmore">
                <span class="js-open">Читать</span>
                <span class="js-close">Свернуть</span>
            </div>
        </div>
    </div>
<?
}

if (CModule::IncludeModule("iblock")) {
    $arFilter = array(
        "IBLOCK_ID" => 42, // инфоблок Шахматный текст
        "ACTIVE" => "Y",
        "ID" => 437213, // Префутер на главной
    );
    $dbEl = CIBlockElement::GetList(Array(), $arFilter, false, false, Array('ID', 'IBLOCK_ID', 'NAME', 'ALT_*'));
    if($obEl = $dbEl->GetNextElement()) {
        $arSect = $obEl->GetProperties();
    }
    for($cou = 1; $cou < 10; $cou++){
        $title = $pic = $alt = $text = '';
        if ($arSect['ALT_ALT_' . $cou]['VALUE']) {
            $alt = $arSect['ALT_ALT_' . $cou]['~VALUE'];
        }
        if ($arSect['ALT_TITLE_' . $cou]['VALUE']) {
            $title = '<h2>' . $arSect['ALT_TITLE_' . $cou]['~VALUE'] . '</h2>';
        }
        if ($arSect['ALT_PICTURE_' . $cou]['VALUE']) {
            $pic = '<img src="'.CFile::GetPath($arSect['ALT_PICTURE_' . $cou]['VALUE']).'" alt="' . $alt . '" title="' . $alt . '" />';
        }
        if ($arSect['ALT_TEXT_' . $cou]['VALUE']['TEXT']) {
            $text = $arSect['ALT_TEXT_' . $cou]['~VALUE']['TEXT'];
        }
        if($title || $pic || $text) {
            $descr .= '<div class="altdescr_box"><div class="altdescr_pic">' . $pic . '</div><div class="altdescr_text">' . $title . $text . '</div><div class="clear"></div></div>';
        }
    }
}
?>
<div class="page-content">
    <?= $descr; ?>
    <br />
</div>
<style>
    ul.rows2 li {
        width: 50%;
        float: left;
        list-style: square outside;
    }
</style>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>