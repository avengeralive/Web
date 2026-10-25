<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$arBrand = $APPLICATION->IncludeComponent(
    "5corners:brand.detail",
    "",
    array(
        "COMPONENT_TEMPLATE" => "",
        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'],
        "SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
        "CATEGORY_COLLECTION" => $arResult['VARIABLES']['CATEGORY_COLLECTION'],
        "SECTION_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "FOLDER" => $arResult['FOLDER'],
        "URL" => $arResult['URL_TEMPLATES'],
        "CACHE_TYPE" => $arParams['CACHE_TYPE'],
        "CACHE_TIME" => $arParams['CACHE_TIME'],
        "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
        "CACHE_FILTER" => $arParams['CACHE_FILTER'],
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);

global $arrBrandFilter;
$arrBrandFilter = $arBrand['FILTER'];
$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "bread",
    Array(
        "START_FROM" => "1",
        "PATH" => "",
        "SITE_ID" => ""
    ), false
); ?>

    <section class="catalog-nav brand_nav">

        <? if (!empty($arBrand['CATEGORIES'])): ?>
            <div class="catalog-nav-sub">
                <span class="catalog-nav-href">Разделы <?= $arBrand['SECTION']['NAME'] ?></span>
                <div class="catalog-nav-inner">
                    <? foreach ($arBrand['CATEGORIES'] as $section): ?>
                        <a class="catalog-nav-inner-href<?= $section['ACTIVE'] ? ' active' : '' ?>"
                           href="<?= $section['DETAIL_PAGE_URL'] ?>"><?= $section['NAME'] ?></a>
                    <? endforeach ?>
                </div>
            </div>
        <? endif; ?>

        <? if (!empty($arBrand['COLLECTIONS'])): ?>
            <div class="catalog-nav-sub">
                <span class="catalog-nav-href">Коллекции <?= $arBrand['SECTION']['NAME'] ?></span>
                <div class="catalog-nav-inner">
                    <? foreach ($arBrand['COLLECTIONS'] as $collection): ?>
                        <a class="catalog-nav-inner-href<?= $collection['ACTIVE'] ? ' active' : '' ?>"
                           href="<?= $collection['DETAIL_PAGE_URL'] ?>"><?= $collection['NAME'] ?></a>
                    <? endforeach ?>
                </div>
            </div>
        <? endif; ?>

        <?
        //Массивы с сортировками
        global $APPLICATION;
        global $arSort, $arPagen, $sort, $sort_filed, $sort_order, $pagen;

        $arSort = array(
            array(
                "NAME" => 'популярности',
                "CODE" => 'popular',
                "FIELD" => 'SORT',
                "ORDER" => 'ASC'
            ),
            array(
                "NAME" => 'цене, от самой низкой',
                "CODE" => 'price_asc',
                //"FIELD" => 'catalog_PRICE_1',
                "FIELD" => 'PROPERTY_sort_price',
                "ORDER" => 'ASC'
            ),
            array(
                "NAME" => 'цене, от самой высокой',
                "CODE" => 'price_desc',
                //"FIELD" => 'catalog_PRICE_1',
                "FIELD" => 'PROPERTY_sort_price',
                "ORDER" => 'DESC'
            ),
            array(
                "NAME" => 'имени, от А до Я',
                "CODE" => 'name_asc',
                "FIELD" => 'NAME',
                "ORDER" => 'ASC'
            ),
            array(
                "NAME" => 'имени, от Я до А',
                "CODE" => 'name_desc',
                "FIELD" => 'NAME',
                "ORDER" => 'DESC'
            ),
        );

        $arPagen = array(12, 24, 48);

        //Устанавливаем
        if (isset($_REQUEST['sort'])) {
            foreach ($arSort as $s) {
                if ($s['CODE'] == $_REQUEST['sort']) {
                    $APPLICATION->set_cookie("sort", $s['CODE'], time() + 60 * 60 * 24);
                    $APPLICATION->set_cookie("sort_filed", $s['FIELD'], time() + 60 * 60 * 24);
                    $APPLICATION->set_cookie("sort_order", $s['ORDER'], time() + 60 * 60 * 24);
                    $sort = $s['CODE'];
                    $sort_filed = $s['FIELD'];
                    $sort_order = $s['ORDER'];
                };
            };
        } else {
            $sort = $APPLICATION->get_cookie("sort");
            if (empty($sort)) {
                $APPLICATION->set_cookie("sort", $arSort[0]['CODE'], time() + 60 * 60 * 24);
                $APPLICATION->set_cookie("sort_filed", $arSort[0]['FIELD'], time() + 60 * 60 * 24);
                $APPLICATION->set_cookie("sort_order", $arSort[0]['ORDER'], time() + 60 * 60 * 24);
                $sort = $arSort[0]['CODE'];
                $sort_filed = $$arSort[0]['FIELD'];
                $sort_order = $arSort[0]['ORDER'];
            } else {
                $sort_filed = $APPLICATION->get_cookie("sort_filed");
                $sort_order = $APPLICATION->get_cookie("sort_order");
            };
        };
        ?>

        <div class="catalog-nav-sort">
            <form action="" id="filter" method="get">
                <span class="catalog-nav-href">Сортировать по</span>
                <span class="sort-container">
        <? foreach ($arSort as $s): ?>
            <? if ($sort == $s['CODE']): ?><span class="catalog-nav-href-name"><?= $s['NAME'] ?></span><? endif; ?>
        <? endforeach; ?>
                    <select class="sort-select" name="sort">
            <? foreach ($arSort as $s): ?>
                <option <? if ($sort == $s['CODE']): ?>selected<? endif; ?>
                        value="<?= $s['CODE'] ?>"><?= $s['NAME'] ?></option>
            <? endforeach; ?>
        </select>
    </span>
            </form>
        </div>

        <script>
            $(document).ready(function () {
                $('.sort-select').change(function () {
                    console.log("test");
                    $('#filter').submit();
                });
            });
        </script>

        <div class="clear"></div>
    </section>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section", "search", array(
    "IBLOCK_TYPE" => "catalog",
    "IBLOCK_ID" => "2",
    "SECTION_ID" => "",
    "SECTION_CODE" => $arBrand['CATEGORY']['CODE'] ? $arBrand['CATEGORY']['CODE'] : '',
    "SECTION_USER_FIELDS" => array(
        0 => "",
        1 => "",
    ),
    "ELEMENT_SORT_FIELD" => $sort_filed,
    "ELEMENT_SORT_ORDER" => $sort_order,
    "ELEMENT_SORT_FIELD2" => "DATE_CREATE",
    "ELEMENT_SORT_ORDER2" => "DESC",
    "FILTER_NAME" => "arrBrandFilter",
    "INCLUDE_SUBSECTIONS" => "Y",
    "SHOW_ALL_WO_SECTION" => "Y",
    "HIDE_NOT_AVAILABLE" => "N",
    "PAGE_ELEMENT_COUNT" => $_GET["limit"] ? intval($_GET["limit"]) : 32,
    "LINE_ELEMENT_COUNT" => "4",
    "PROPERTY_CODE" => array(
        0 => "ARTNUMBER",
        1 => "strana",
        2 => "",
    ),
    "OFFERS_LIMIT" => "5",
    "ADD_PICT_PROP" => "-",
    "LABEL_PROP" => "-",
    "PRODUCT_SUBSCRIPTION" => "N",
    "SHOW_DISCOUNT_PERCENT" => "N",
    "SHOW_OLD_PRICE" => "Y",
    "MESS_BTN_BUY" => "",
    "MESS_BTN_ADD_TO_BASKET" => "",
    "MESS_BTN_SUBSCRIBE" => "",
    "MESS_BTN_DETAIL" => "",
    "MESS_NOT_AVAILABLE" => "",
    "SECTION_URL" => "",
    "DETAIL_URL" => "",
    "SECTION_ID_VARIABLE" => "SECTION_CODE",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "CACHE_GROUPS" => "Y",
    "SET_META_KEYWORDS" => "N",
    //"META_KEYWORDS" => "UF_KEYWORDS",
    "SET_META_DESCRIPTION" => "N",
    //"META_DESCRIPTION" => "UF_META_DESCRIPTION",
    // "BROWSER_TITLE" => "UF_BROWSER_TITLE",
    "BROWSER_TITLE" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "DISPLAY_COMPARE" => "N",
    "SET_TITLE" => "N",
    "SET_STATUS_404" => "Y",
    "CACHE_FILTER" => "N",
    "PRICE_CODE" => array(
        0 => "BASE",
    ),
    "USE_PRICE_COUNT" => "N",
    "SHOW_PRICE_COUNT" => "1",
    "PRICE_VAT_INCLUDE" => "Y",
    "CONVERT_CURRENCY" => "Y",
    "BASKET_URL" => "/personal/cart/",
    "ACTION_VARIABLE" => "action",
    "PRODUCT_ID_VARIABLE" => "id",
    "USE_PRODUCT_QUANTITY" => "N",
    "ADD_PROPERTIES_TO_BASKET" => "Y",
    "PRODUCT_PROPS_VARIABLE" => "prop",
    "PARTIAL_PRODUCT_PROPERTIES" => "N",
    "PRODUCT_PROPERTIES" => array(),
    "PAGER_TEMPLATE" => "",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Товары",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "Y",
    "AJAX_OPTION_ADDITIONAL" => "",
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
    "CURRENCY_ID" => "RUB",
),
    $component
);

if (!empty($arBrand["COLLECTION"])) { ?>
    <div class="catalog-numbers-promo">
        <?= $arBrand["COLLECTION"]["DETAIL_TEXT"]; ?>
    </div>
    <?
    $APPLICATION->SetPageProperty("title", $arBrand["COLLECTION"]["META"]["ELEMENT_META_TITLE"]);
    $APPLICATION->SetPageProperty("description", $arBrand["COLLECTION"]["META"]["ELEMENT_META_DESCRIPTION"]);
    $APPLICATION->SetPageProperty("keywords", $arBrand["COLLECTION"]["META"]["ELEMENT_META_KEYWORDS"]);
} elseif (!empty($arBrand['DESCRIPTION']) and
    (
        (isset($_GET['PAGEN_2']) and $_GET['PAGEN_2'] < 2) or
        (isset($_GET['PAGEN_3']) and $_GET['PAGEN_3'] < 2) or
        (!isset($_GET['PAGEN_3']) and !isset($_GET['PAGEN_3']))
    )
) {
    ?>
    <div class="catalog-numbers-promo">
        <?= $arBrand['DESCRIPTION']; ?>
    </div>
<? } ?>