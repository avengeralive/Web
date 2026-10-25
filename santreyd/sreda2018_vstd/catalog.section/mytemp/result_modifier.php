<?

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$arDefaultParams = array(
    'TEMPLATE_THEME' => 'blue',
    'PRODUCT_DISPLAY_MODE' => 'N',
    'ADD_PICT_PROP' => '-',
    'LABEL_PROP' => '-',
    'OFFER_ADD_PICT_PROP' => '-',
    'OFFER_TREE_PROPS' => array('-'),
    'PRODUCT_SUBSCRIPTION' => 'N',
    'SHOW_DISCOUNT_PERCENT' => 'N',
    'SHOW_OLD_PRICE' => 'N',
    'ADD_TO_BASKET_ACTION' => 'ADD',
    'SHOW_CLOSE_POPUP' => 'N',
    'MESS_BTN_BUY' => '',
    'MESS_BTN_ADD_TO_BASKET' => '',
    'MESS_BTN_SUBSCRIBE' => '',
    'MESS_BTN_DETAIL' => '',
    'MESS_NOT_AVAILABLE' => '',
    'MESS_BTN_COMPARE' => ''
);
$arParams = array_merge($arDefaultParams, $arParams);

if (!isset($arParams['LINE_ELEMENT_COUNT']))
    $arParams['LINE_ELEMENT_COUNT'] = 4;
$arParams['LINE_ELEMENT_COUNT'] = intval($arParams['LINE_ELEMENT_COUNT']);
if (2 > $arParams['LINE_ELEMENT_COUNT'] || 5 < $arParams['LINE_ELEMENT_COUNT'])
    $arParams['LINE_ELEMENT_COUNT'] = 4;


if ('Y' != $arParams['PRODUCT_DISPLAY_MODE'])
    $arParams['PRODUCT_DISPLAY_MODE'] = 'N';

$arParams['ADD_PICT_PROP'] = trim($arParams['ADD_PICT_PROP']);
if ('-' == $arParams['ADD_PICT_PROP'])
    $arParams['ADD_PICT_PROP'] = '';
$arParams['LABEL_PROP'] = trim($arParams['LABEL_PROP']);
if ('-' == $arParams['LABEL_PROP'])
    $arParams['LABEL_PROP'] = '';
$arParams['OFFER_ADD_PICT_PROP'] = trim($arParams['OFFER_ADD_PICT_PROP']);
if ('-' == $arParams['OFFER_ADD_PICT_PROP'])
    $arParams['OFFER_ADD_PICT_PROP'] = '';
if ('Y' == $arParams['PRODUCT_DISPLAY_MODE']) {
    if (!is_array($arParams['OFFER_TREE_PROPS']))
        $arParams['OFFER_TREE_PROPS'] = array($arParams['OFFER_TREE_PROPS']);
    foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value) {
        $value = (string)$value;
        if ('' == $value || '-' == $value)
            unset($arParams['OFFER_TREE_PROPS'][$key]);
    }
    if (empty($arParams['OFFER_TREE_PROPS']) && isset($arParams['OFFERS_CART_PROPERTIES']) && is_array($arParams['OFFERS_CART_PROPERTIES'])) {
        $arParams['OFFER_TREE_PROPS'] = $arParams['OFFERS_CART_PROPERTIES'];
        foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value) {
            $value = (string)$value;
            if ('' == $value || '-' == $value)
                unset($arParams['OFFER_TREE_PROPS'][$key]);
        }
    }
} else {
    $arParams['OFFER_TREE_PROPS'] = array();
}
if ('Y' != $arParams['PRODUCT_SUBSCRIPTION'])
    $arParams['PRODUCT_SUBSCRIPTION'] = 'N';
if ('Y' != $arParams['SHOW_DISCOUNT_PERCENT'])
    $arParams['SHOW_DISCOUNT_PERCENT'] = 'N';
if ('Y' != $arParams['SHOW_OLD_PRICE'])
    $arParams['SHOW_OLD_PRICE'] = 'N';
if ($arParams['ADD_TO_BASKET_ACTION'] != 'BUY')
    $arParams['ADD_TO_BASKET_ACTION'] = 'ADD';
if ($arParams['SHOW_CLOSE_POPUP'] != 'Y')
    $arParams['SHOW_CLOSE_POPUP'] = 'N';
$arParams['MESS_BTN_BUY'] = trim($arParams['MESS_BTN_BUY']);
$arParams['MESS_BTN_ADD_TO_BASKET'] = trim($arParams['MESS_BTN_ADD_TO_BASKET']);
$arParams['MESS_BTN_SUBSCRIBE'] = trim($arParams['MESS_BTN_SUBSCRIBE']);
$arParams['MESS_BTN_DETAIL'] = trim($arParams['MESS_BTN_DETAIL']);
$arParams['MESS_NOT_AVAILABLE'] = trim($arParams['MESS_NOT_AVAILABLE']);
$arParams['MESS_BTN_COMPARE'] = trim($arParams['MESS_BTN_COMPARE']);

if (!empty($arResult['ITEMS'])) {

    $arEmptyPreview = false;
    $strEmptyPreview = $this->GetFolder() . '/images/no_photo.png';
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $strEmptyPreview)) {
        $arSizes = getimagesize($_SERVER['DOCUMENT_ROOT'] . $strEmptyPreview);
        if (!empty($arSizes)) {
            $arEmptyPreview = array(
                'SRC' => $strEmptyPreview,
                'WIDTH' => intval($arSizes[0]),
                'HEIGHT' => intval($arSizes[1])
            );
        }
        unset($arSizes);
    }
    unset($strEmptyPreview);

    // VARIABLES
    $pic_width = 297;
    $pic_height = 297;
    $prop_code_country = 'strana';
    $prop_code_brand = 'MANUFACTURER';

    $arNewItemsList = array();
    foreach ($arResult['ITEMS'] as $key => $arItem) {
        $arItem['CHECK_QUANTITY'] = false;

        $productPictures = CIBlockPriceTools::getDoublePicturesForItem($arItem, $arParams['ADD_PICT_PROP']);
        if (empty($productPictures['PICT']))
            $productPictures['PICT'] = $arEmptyPreview;

        $arItem['PREVIEW_PICTURE'] = $productPictures['PICT'];
        //$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>$pic_width, 'height'=>$pic_height), BX_RESIZE_IMAGE_EXACT, true);

        $file = thumb($arItem['PREVIEW_PICTURE']['ID'], array('width' => $pic_width, 'height' => $pic_height), BX_RESIZE_IMAGE_EXACT, $arItem["PROPERTIES"]["picture_type"]["VALUE_XML_ID"]);

        $arItem['PREVIEW_PICTURE'] = $file;
        $arItem['PREVIEW_PICTURE']['SRC'] = $file['src'];

        if (!empty($arItem['DISPLAY_PROPERTIES'])) {
            $prop_country_IDS[] = $arItem['DISPLAY_PROPERTIES'][$prop_code_country]['VALUE'];
            $prop_country_IBLOCK_ID = $arItem['DISPLAY_PROPERTIES'][$prop_code_country]['LINK_IBLOCK_ID'];
            $prop_brand_IDS[] = $arItem['DISPLAY_PROPERTIES'][$prop_code_brand]['VALUE'];
            $prop_brand_IBLOCK_ID = $arItem['DISPLAY_PROPERTIES'][$prop_code_brand]['LINK_IBLOCK_ID'];
            foreach ($arItem['DISPLAY_PROPERTIES'] as $propKey => $arDispProp) {
                if ('F' == $arDispProp['PROPERTY_TYPE'])
                    unset($arItem['DISPLAY_PROPERTIES'][$propKey]);
            }
        }
        $arItem['LAST_ELEMENT'] = 'N';
        $arNewItemsList[$key] = $arItem;
    }

    if (!empty($prop_country_IDS) and $prop_country_IBLOCK_ID > 0) {
        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => IntVal($prop_country_IBLOCK_ID), "ACTIVE" => "Y", 'ID' => $prop_country_IDS);
        $res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $COUNTRIES[$arFields['ID']] = $arFields['NAME'];
        }
    };

    if (!empty($prop_brand_IDS) and $prop_brand_IBLOCK_ID > 0) {
        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => IntVal($prop_brand_IBLOCK_ID), "ACTIVE" => "Y", 'ID' => $prop_brand_IDS);
        $res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $BRANDS[$arFields['ID']] = $arFields['NAME'];
        }
    };

    foreach ($arNewItemsList as $key => $arItem) {
        $arItem['BRAND'] = $BRANDS[$arItem['DISPLAY_PROPERTIES'][$prop_code_brand]['VALUE']];
        $arItem['COUNTRY'] = $COUNTRIES[$arItem['DISPLAY_PROPERTIES'][$prop_code_country]['VALUE']];


        $arItem['LABEL_CLASS'] = '';
        if ($arItem['PROPERTIES']['NEWPRODUCT']['VALUE'] == 'да') {
            //	$arItem['LABEL_CLASS'] .= ' with-new';
        };
        if ($arItem['PROPERTIES']['SALELEADER']['VALUE'] == 'да') {
            //	$arItem['LABEL_CLASS'] .= ' with-star';
        };
        if ($arItem['PROPERTIES']['SPECIALOFFER']['VALUE'] == 'да') {
            //	$arItem['LABEL_CLASS'] .= ' with-sale';
        };


        $arNewItemsList[$key] = $arItem;
    }


    $arNewItemsList[$key]['LAST_ELEMENT'] = 'Y';
    $arResult['ITEMS'] = $arNewItemsList;
    $arResult['DEFAULT_PICTURE'] = $arEmptyPreview;

    $arResult['CURRENCIES'] = array();


    //Month Product
    function productMonth($iblock_id, $section_id = false)
    {
        CModule::IncludeModule('iblock');
        CModule::IncludeModule('sale');
        CModule::IncludeModule('catalog');
        global $USER;
        $currency = "RUB";

        $arSecIDs = array();
        $arSecIDs[] = $section_id;
        if ($section_id) {
            $nav = CIBlockSection::GetNavChain(false, $section_id);
            while ($arSectionPath = $nav->GetNext()) {
                if ($arSectionPath["ID"] !== $section_id && $arSectionPath["IBLOCK_SECTION_ID"])
                    array_unshift($arSecIDs, $arSectionPath["ID"]);
            }
        }

        $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PREVIEW_PICTURE");
        foreach ($arSecIDs as $SecID) {
            $arFilter = Array("IBLOCK_ID" => IntVal($iblock_id), "ACTIVE" => "Y", 'PROPERTY_MONTH' => 1, "SECTION_ID" => $SecID, "INCLUDE_SUBSECTIONS" => "Y");
            $res = CIBlockElement::GetList(Array('SORT' => 'ASC'), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields['PROPERTIES'] = $ob->GetProperties();
                if (!empty($arFields['DETAIL_PICTURE'])) {
                    $image = $arFields['DETAIL_PICTURE'];
                } elseif (!empty($arFields['PREVIEW_PICTURE'])) {
                    $image = $arFields['PREVIEW_PICTURE'];
                }

                if (!empty($image)) {
                    $file = thumb($image, array('width' => 1192, 'height' => 810), BX_RESIZE_IMAGE_EXACT, $arFields["PROPERTIES"]["picture_type"]["VALUE_XML_ID"]);
                    $arFields['PREVIEW_PICTURE'] = $file;
                    $arFields['PREVIEW_PICTURE']['SRC'] = $file['src'];
                }

                $ar_res = CCatalogProduct::GetOptimalPrice($arFields['ID'], 1, $USER->GetUserGroupArray(), 'N');
                //d($ar_res);
                if ($ar_res["RESULT_PRICE"]["BASE_PRICE"] > $ar_res["RESULT_PRICE"]["DISCOUNT_PRICE"]) {
                    $arFields['OLD_PRICE'] = CCurrencyRates::ConvertCurrency($ar_res["RESULT_PRICE"]["BASE_PRICE"], $ar_res["RESULT_PRICE"]["CURRENCY"], $currency);
                    $arFields['OLD_PRICE'] = CurrencyFormat($arFields['OLD_PRICE'], $currency);
                }

                $arFields['PRICE'] = CCurrencyRates::ConvertCurrency($ar_res["RESULT_PRICE"]["DISCOUNT_PRICE"], $ar_res["RESULT_PRICE"]["CURRENCY"], $currency);
                $arFields['PRICE'] = CurrencyFormat($arFields['PRICE'], $currency);

                return $arFields;
            }
            // else{
            // return false;
            // };
        }
        return false;

    }

    ; //productMonth();

    $arResult['PRODUCT_MONTH'] = productMonth($arParams['IBLOCK_ID'], $arResult['ID']);

    //Популярные разделы
    $res = CIBlockSection::GetList(array('SORT' => 'ASC', 'element_cnt' => 'desc'), array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE" => "Y", "SECTION_ID" => $arResult['ID'], "!ID" => $arResult['ID']), true, array("ID", "NAME", "SECTION_PAGE_URL"), array('nPageSize' => 16));
    while ($ar_res = $res->GetNext()) {
        $arResult["POPULAR"][] = $ar_res;
    }

    if (empty($arResult["POPULAR"])) {
        $res = CIBlockSection::GetList(array('element_cnt' => 'desc'), array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE" => "Y", "SECTION_ID" => $arResult['IBLOCK_SECTION_ID'], "!ID" => $arResult['ID']), true, array("ID", "NAME", "SECTION_PAGE_URL"), array('nPageSize' => 16));
        while ($ar_res = $res->GetNext()) {
            $arResult["POPULAR"][] = $ar_res;
        }
    }

    //d($arResult);
    /*
        $rsParentSection = CIBlockSection::GetByID($arResult['IBLOCK_SECTION_ID']);
        if ($arParentSection = $rsParentSection->GetNext())
        {
           $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
           $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter, false, array("ID","NAME", "SECTION_PAGE_URL"), array('nPageSize'=>10));
           while ($arSect = $rsSect->GetNext())
           {
              $arResult["POPULAR"][] = $arSect;
           }
        }

    */

}

$arResult["ALT_DESCRIPTION"] = false;
$arFilter = array(
    "IBLOCK_ID" => $arResult["IBLOCK_ID"],
    "ID" => $arResult["ID"],
);
$rsSect = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "NAME", "UF_*"));
if ($arSect = $rsSect->GetNext()) {
    $pic = CFile::GetPath(COption::GetOptionString("askaron.settings", "UF_CATPROMO_PICTURE"));
    if ($arSect["UF_PROMO_PICTURE"])
        $pic = CFile::GetPath($arSect["UF_PROMO_PICTURE"]);
    $arResult["PROMO"] = array(
        "H1" => $arSect["UF_PROMO_H1"],
        "DESCRIPTION" => $arSect["UF_PROMO_DESCRIPTION"],
        "PICTURE" => $pic,
    );

    if ($arSect["UF_USE_ALTDESCR"]) {
        $descr = '';
        $arResult['ALT_NAME'] = '';
        // if($arSect["UF_ALT_H1"])
        // $arResult['ALT_NAME'] = $arSect["UF_ALT_H1"];
        for ($cou = 1; $cou < 21; $cou++) {
            $title = '';
            $pic = '';
            $alt = '';
            $text = '';
            if ($arSect["UF_TITLE_" . $cou])
                $title = $arSect["UF_TITLE_" . $cou];
            if ($arSect["UF_ALT_" . $cou])
                $alt = $arSect["UF_ALT_" . $cou];
            if ($arSect["UF_PICTURE_" . $cou]) {
                $pic = '<img src="' . CFile::GetPath($arSect["UF_PICTURE_" . $cou]) . '" alt="' . $alt . '" title="' . $alt . '" />';
            }
            if ($arSect["UF_TEXT_" . $cou])
                $text = $arSect["~UF_TEXT_" . $cou];
            if ($title || $pic || $text)
                $descr .= '<div class="altdescr_box"><div class="altdescr_pic">' . $pic . '</div><div class="altdescr_text"><h2>' . $title . '</h2>' . $text . '</div><div class="clear"></div></div>';
        }
        $arResult["ALT_DESCRIPTION"] = true;
        $arResult["DESCRIPTION"] = $descr;
    }
// echo '<pre style="display:none;">';print_r($arSect);echo '</pre>';
}
?>