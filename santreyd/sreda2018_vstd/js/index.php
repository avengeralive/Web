<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "брендовая сантехника,сантехника бренд,бренды сантехники");
$APPLICATION->SetPageProperty("description", "Ищете дизайнерскую сантехнику?! Лучшие товары по лучшей цене! Интернет-магазин Сантрейд представляет сотни брендов, тысячи коллекций от лучших мировых фабрик. Знакомьтесь и выбирайте!");
$APPLICATION->SetPageProperty("title", "Сантехника мировых фабрик от \"А\" до \"Я\"!");
$APPLICATION->SetTitle("Полный каталог сантехники всех известных брендов в интернет магазине Сантрейд");

global $USER;
$arGroupAvalaible = array(1,7,10,12);
$arGroups = CUser::GetUserGroup($USER->GetID());
$result_intersect = array_intersect($arGroupAvalaible, $arGroups);
$template = 'bxmaker_ajaxpagenav_default';
// убрать true || чтобы работала автоподгрузка страниц при перемотке
if(true || !empty($result_intersect))
	$template = '.default';
//var_dump("WE ARE HERE!!!");
?>
<style>.catalog-numbers-all { display: none; } .s-loft { padding-top: 20px; }</style>
<?$APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter",
            "sreda",
            array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "2",
                "SECTION_ID" => 0,
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => 3600,
                "CACHE_GROUPS" => "N",
                "SAVE_IN_SESSION" => "N",
                "INSTANT_RELOAD" => "N",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "COMPONENT_TEMPLATE" => "",
                "HIDE_NOT_AVAILABLE" => "Y",
                "TEMPLATE_THEME" => "blue",
                "FILTER_VIEW_MODE" => "horizontal",
                "POPUP_POSITION" => "left",
                "DISPLAY_ELEMENT_COUNT" => "Y",
                "SEF_MODE" => "Y",
                "SEF_RULE" => "/catalog/#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
                "SECTION_CODE" => "",
                "SECTION_CODE_PATH" => "",
                "SMART_FILTER_PATH" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "CONVERT_CURRENCY" => "N",
                "XML_EXPORT" => "N",
                "SECTION_TITLE" => "-",
                "SECTION_DESCRIPTION" => "-"
            ),
            false
        );?>

<section class="catalog-cols">
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    ".default",
    array(
        "IBLOCK_TYPE_ID" => "catalog",
        "IBLOCK_ID" => "2",
        "BASKET_URL" => "/personal/cart/",
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "catalog",
        "SECTION_ID" => 0,
        "SECTION_CODE" => "",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_ORDER" => "desc",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_NAME" => "trendFilter",
        "INCLUDE_SUBSECTIONS" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y",
        "HIDE_NOT_AVAILABLE" => "N",
        "PAGE_ELEMENT_COUNT" => "18",
        "LINE_ELEMENT_COUNT" => "3",
        "PROPERTY_CODE" => array(
            0 => "NEWPRODUCT",
            1 => "",
        ),
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_PROPERTY_CODE" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
            3 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_ORDER" => "desc",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER2" => "desc",
        "TEMPLATE_THEME" => "site",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "LABEL_PROP" => array(
            0 => "NEWPRODUCT"
        ),
        "OFFER_ADD_PICT_PROP" => "-",
        "OFFER_TREE_PROPS" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
        ),
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "Y",
        "SHOW_CLOSE_POPUP" => "N",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SEF_MODE" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "SET_TITLE" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_LAST_MODIFIED" => "N",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_FILTER" => "N",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRICE_CODE" => array(
            0 => "BASE",
        ),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRODUCT_PROPERTIES" => array(
        ),
        "OFFERS_CART_PROPERTIES" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
        ),
        "ADD_TO_BASKET_ACTION" => "ADD",
        "PAGER_TEMPLATE" => $template,
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Товары",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "COMPATIBLE_MODE" => "N",
    ),
    false
);?>
</section>
<?
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
    for($cou = 1; $cou < 4; $cou++){
        $title = $pic = $alt = $text = '';
        if ($arSect['ALT_ALT_' . $cou]['VALUE']) {
            $alt = $arSect['ALT_ALT_' . $cou]['~VALUE'];
        }
        if ($arSect['ALT_TITLE_' . $cou]['VALUE']) {
            $title = '<h3>' . $arSect['ALT_TITLE_' . $cou]['~VALUE'] . '</h3>';
        }
        if ($arSect['ALT_PICTURE_' . $cou]['VALUE']) {
            $pic = '<img src="'.CFile::GetPath($arSect['ALT_PICTURE_' . $cou]['VALUE']).'" alt="' . $alt . '" title="' . $alt . '" />';
        }
        if ($arSect['ALT_TEXT_' . $cou]['VALUE']['TEXT']) {
            $text = $arSect['ALT_TEXT_' . $cou]['~VALUE']['TEXT'];
        }
        if($title || $pic || $text) {
            $descr .= '<div class="s-loft__item"><div class="s-loft__img">' . $pic . '</div><div class="s-loft__content">' . $title . $text . '</div></div>';
        }
    }
}
?>
        <section class="s-loft">
            <h2>Популярное предложение</h2>
            <div class="s-loft-wrap">
                <?= $descr; ?>
            </div>
        </section>

        

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>