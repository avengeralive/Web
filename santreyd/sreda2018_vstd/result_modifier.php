<?

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;
use Bitrix\Iblock;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$displayPreviewTextMode = array(
    'H' => true,
    'E' => true,
    'S' => true
);
$detailPictMode = array(
    'IMG' => true,
    'POPUP' => true,
    'MAGNIFIER' => true,
    'GALLERY' => true
);

$arDefaultParams = array(
    'TEMPLATE_THEME' => 'blue',
    'ADD_PICT_PROP' => '-',
    'LABEL_PROP' => '-',
    'OFFER_ADD_PICT_PROP' => '-',
    'OFFER_TREE_PROPS' => array('-'),
    'DISPLAY_NAME' => 'Y',
    'DETAIL_PICTURE_MODE' => 'IMG',
    'ADD_DETAIL_TO_SLIDER' => 'N',
    'DISPLAY_PREVIEW_TEXT_MODE' => 'E',
    'PRODUCT_SUBSCRIPTION' => 'N',
    'SHOW_DISCOUNT_PERCENT' => 'N',
    'SHOW_OLD_PRICE' => 'N',
    'SHOW_MAX_QUANTITY' => 'N',
    'SHOW_BASIS_PRICE' => 'N',
    'ADD_TO_BASKET_ACTION' => array('BUY'),
    'SHOW_CLOSE_POPUP' => 'N',
    'MESS_BTN_BUY' => '',
    'MESS_BTN_ADD_TO_BASKET' => '',
    'MESS_BTN_SUBSCRIBE' => '',
    'MESS_BTN_COMPARE' => '',
    'MESS_NOT_AVAILABLE' => '',
    'USE_VOTE_RATING' => 'N',
    'VOTE_DISPLAY_AS_RATING' => 'rating',
    'USE_COMMENTS' => 'N',
    'BLOG_USE' => 'N',
    'BLOG_URL' => 'catalog_comments',
    'BLOG_EMAIL_NOTIFY' => 'N',
    'VK_USE' => 'N',
    'VK_API_ID' => '',
    'FB_USE' => 'N',
    'FB_APP_ID' => '',
    'BRAND_USE' => 'N',
    'BRAND_PROP_CODE' => ''
);
$arParams = array_merge($arDefaultParams, $arParams);

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ('' != $arParams['TEMPLATE_THEME']) {
    $arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
    if ('site' == $arParams['TEMPLATE_THEME']) {
        $arParams['TEMPLATE_THEME'] = COption::GetOptionString('main', 'wizard_eshop_adapt_theme_id', 'blue', SITE_ID);
    }
    if ('' != $arParams['TEMPLATE_THEME']) {
        if (!is_file($_SERVER['DOCUMENT_ROOT'] . $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css'))
            $arParams['TEMPLATE_THEME'] = '';
    }
}
if ('' == $arParams['TEMPLATE_THEME'])
    $arParams['TEMPLATE_THEME'] = 'blue';

$arParams['ADD_PICT_PROP'] = trim($arParams['ADD_PICT_PROP']);
if ('-' == $arParams['ADD_PICT_PROP'])
    $arParams['ADD_PICT_PROP'] = '';
$arParams['LABEL_PROP'] = trim($arParams['LABEL_PROP']);
if ('-' == $arParams['LABEL_PROP'])
    $arParams['LABEL_PROP'] = '';
$arParams['OFFER_ADD_PICT_PROP'] = trim($arParams['OFFER_ADD_PICT_PROP']);
if ('-' == $arParams['OFFER_ADD_PICT_PROP'])
    $arParams['OFFER_ADD_PICT_PROP'] = '';
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
if ('N' != $arParams['DISPLAY_NAME'])
    $arParams['DISPLAY_NAME'] = 'Y';
if (!isset($detailPictMode[$arParams['DETAIL_PICTURE_MODE']]))
    $arParams['DETAIL_PICTURE_MODE'] = 'IMG';
if ('Y' != $arParams['ADD_DETAIL_TO_SLIDER'])
    $arParams['ADD_DETAIL_TO_SLIDER'] = 'N';
if (!isset($displayPreviewTextMode[$arParams['DISPLAY_PREVIEW_TEXT_MODE']]))
    $arParams['DISPLAY_PREVIEW_TEXT_MODE'] = 'E';
if ('Y' != $arParams['PRODUCT_SUBSCRIPTION'])
    $arParams['PRODUCT_SUBSCRIPTION'] = 'N';
if ('Y' != $arParams['SHOW_DISCOUNT_PERCENT'])
    $arParams['SHOW_DISCOUNT_PERCENT'] = 'N';
if ('Y' != $arParams['SHOW_OLD_PRICE'])
    $arParams['SHOW_OLD_PRICE'] = 'N';
if ('Y' != $arParams['SHOW_MAX_QUANTITY'])
    $arParams['SHOW_MAX_QUANTITY'] = 'N';
if ($arParams['SHOW_BASIS_PRICE'] != 'Y')
    $arParams['SHOW_BASIS_PRICE'] = 'N';
if (!is_array($arParams['ADD_TO_BASKET_ACTION']))
    $arParams['ADD_TO_BASKET_ACTION'] = array($arParams['ADD_TO_BASKET_ACTION']);
$arParams['ADD_TO_BASKET_ACTION'] = array_filter($arParams['ADD_TO_BASKET_ACTION'], 'CIBlockParameters::checkParamValues');
if (empty($arParams['ADD_TO_BASKET_ACTION']) || (!in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']) && !in_array('BUY', $arParams['ADD_TO_BASKET_ACTION'])))
    $arParams['ADD_TO_BASKET_ACTION'] = array('BUY');
if ($arParams['SHOW_CLOSE_POPUP'] != 'Y')
    $arParams['SHOW_CLOSE_POPUP'] = 'N';

$arParams['MESS_BTN_BUY'] = trim($arParams['MESS_BTN_BUY']);
$arParams['MESS_BTN_ADD_TO_BASKET'] = trim($arParams['MESS_BTN_ADD_TO_BASKET']);
$arParams['MESS_BTN_SUBSCRIBE'] = trim($arParams['MESS_BTN_SUBSCRIBE']);
$arParams['MESS_BTN_COMPARE'] = trim($arParams['MESS_BTN_COMPARE']);
$arParams['MESS_NOT_AVAILABLE'] = trim($arParams['MESS_NOT_AVAILABLE']);
if ('Y' != $arParams['USE_VOTE_RATING'])
    $arParams['USE_VOTE_RATING'] = 'N';
if ('vote_avg' != $arParams['VOTE_DISPLAY_AS_RATING'])
    $arParams['VOTE_DISPLAY_AS_RATING'] = 'rating';
if ('Y' != $arParams['USE_COMMENTS'])
    $arParams['USE_COMMENTS'] = 'N';
if ('Y' != $arParams['BLOG_USE'])
    $arParams['BLOG_USE'] = 'N';
if ('Y' != $arParams['VK_USE'])
    $arParams['VK_USE'] = 'N';
if ('Y' != $arParams['FB_USE'])
    $arParams['FB_USE'] = 'N';
if ('Y' == $arParams['USE_COMMENTS']) {
    if ('N' == $arParams['BLOG_USE'] && 'N' == $arParams['VK_USE'] && 'N' == $arParams['FB_USE'])
        $arParams['USE_COMMENTS'] = 'N';
}
if ('Y' != $arParams['BRAND_USE'])
    $arParams['BRAND_USE'] = 'N';
if ($arParams['BRAND_PROP_CODE'] == '')
    $arParams['BRAND_PROP_CODE'] = array();
if (!is_array($arParams['BRAND_PROP_CODE']))
    $arParams['BRAND_PROP_CODE'] = array($arParams['BRAND_PROP_CODE']);

$arEmptyPreview = false;
$strEmptyPreview = $this->GetFolder() . '/images/no_photo.png';
if (file_exists($_SERVER['DOCUMENT_ROOT'] . $strEmptyPreview)) {
    $arSizes = getimagesize($_SERVER['DOCUMENT_ROOT'] . $strEmptyPreview);
    if (!empty($arSizes)) {
        $arEmptyPreview = array(
            'SRC' => $strEmptyPreview,
            'WIDTH' => (int)$arSizes[0],
            'HEIGHT' => (int)$arSizes[1]
        );
    }
    unset($arSizes);
}
unset($strEmptyPreview);

$arSKUPropList = array();
$arSKUPropIDs = array();
$arSKUPropKeys = array();
$boolSKU = false;
$strBaseCurrency = '';
$boolConvert = isset($arResult['CONVERT_CURRENCY']['CURRENCY_ID']);

if ($arResult['MODULES']['catalog']) {
    if (!$boolConvert)
        $strBaseCurrency = CCurrency::GetBaseCurrency();

    $arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
    $boolSKU = !empty($arSKU) && is_array($arSKU);

    if ($boolSKU && !empty($arParams['OFFER_TREE_PROPS'])) {
        $arSKUPropList = CIBlockPriceTools::getTreeProperties(
            $arSKU,
            $arParams['OFFER_TREE_PROPS'],
            array(
                'PICT' => $arEmptyPreview,
                'NAME' => '-'
            )
        );
        $arSKUPropIDs = array_keys($arSKUPropList);
    }
}

$arResult['CHECK_QUANTITY'] = false;
if (!isset($arResult['CATALOG_MEASURE_RATIO']))
    $arResult['CATALOG_MEASURE_RATIO'] = 1;
if (!isset($arResult['CATALOG_QUANTITY']))
    $arResult['CATALOG_QUANTITY'] = 0;
$arResult['CATALOG_QUANTITY'] = (
0 < $arResult['CATALOG_QUANTITY'] && is_float($arResult['CATALOG_MEASURE_RATIO'])
    ? (float)$arResult['CATALOG_QUANTITY']
    : (int)$arResult['CATALOG_QUANTITY']
);
$arResult['CATALOG'] = false;
if (!isset($arResult['CATALOG_SUBSCRIPTION']) || 'Y' != $arResult['CATALOG_SUBSCRIPTION'])
    $arResult['CATALOG_SUBSCRIPTION'] = 'N';

CIBlockPriceTools::getLabel($arResult, $arParams['LABEL_PROP']);

$productSlider = CIBlockPriceTools::getSliderForItem($arResult, $arParams['ADD_PICT_PROP'], 'Y' == $arParams['ADD_DETAIL_TO_SLIDER']);
if (empty($productSlider)) {
    $productSlider = array(
        0 => $arEmptyPreview
    );
}
$productSliderCount = count($productSlider);
$arResult['SHOW_SLIDER'] = true;
$arResult['MORE_PHOTO'] = $productSlider;
$arResult['MORE_PHOTO_COUNT'] = count($productSlider);

if ($arResult['MODULES']['catalog']) {
    $arResult['CATALOG'] = true;
    if (!isset($arResult['CATALOG_TYPE']))
        $arResult['CATALOG_TYPE'] = CCatalogProduct::TYPE_PRODUCT;
    if (
        (CCatalogProduct::TYPE_PRODUCT == $arResult['CATALOG_TYPE'] || CCatalogProduct::TYPE_SKU == $arResult['CATALOG_TYPE'])
        && !empty($arResult['OFFERS'])
    ) {
        $arResult['CATALOG_TYPE'] = CCatalogProduct::TYPE_SKU;
    }
    switch ($arResult['CATALOG_TYPE']) {
        case CCatalogProduct::TYPE_SET:
            $arResult['OFFERS'] = array();
            $arResult['CHECK_QUANTITY'] = ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO']);
            break;
        case CCatalogProduct::TYPE_SKU:
            break;
        case CCatalogProduct::TYPE_PRODUCT:
        default:
            $arResult['CHECK_QUANTITY'] = ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO']);
            break;
    }
} else {
    $arResult['CATALOG_TYPE'] = 0;
    $arResult['OFFERS'] = array();
}

if ($arResult['CATALOG'] && isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
    $boolSKUDisplayProps = false;

    $arResultSKUPropIDs = array();
    $arFilterProp = array();
    $arNeedValues = array();
    foreach ($arResult['OFFERS'] as &$arOffer) {
        foreach ($arSKUPropIDs as &$strOneCode) {
            if (isset($arOffer['DISPLAY_PROPERTIES'][$strOneCode])) {
                $arResultSKUPropIDs[$strOneCode] = true;
                if (!isset($arNeedValues[$arSKUPropList[$strOneCode]['ID']]))
                    $arNeedValues[$arSKUPropList[$strOneCode]['ID']] = array();
                $valueId = (
                $arSKUPropList[$strOneCode]['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_LIST
                    ? $arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE_ENUM_ID']
                    : $arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']
                );
                $arNeedValues[$arSKUPropList[$strOneCode]['ID']][$valueId] = $valueId;
                unset($valueId);
                if (!isset($arFilterProp[$strOneCode]))
                    $arFilterProp[$strOneCode] = $arSKUPropList[$strOneCode];
            }
        }
        unset($strOneCode);
    }
    unset($arOffer);

    CIBlockPriceTools::getTreePropertyValues($arSKUPropList, $arNeedValues);
    $arSKUPropIDs = array_keys($arSKUPropList);
    $arSKUPropKeys = array_fill_keys($arSKUPropIDs, false);


    $arMatrixFields = $arSKUPropKeys;
    $arMatrix = array();

    $arNewOffers = array();

    $arIDS = array($arResult['ID']);
    $arOfferSet = array();
    $arResult['OFFER_GROUP'] = false;
    $arResult['OFFERS_PROP'] = false;

    $arDouble = array();
    foreach ($arResult['OFFERS'] as $keyOffer => $arOffer) {
        $arOffer['ID'] = (int)$arOffer['ID'];
        if (isset($arDouble[$arOffer['ID']]))
            continue;
        $arIDS[] = $arOffer['ID'];
        $boolSKUDisplayProperties = false;
        $arOffer['OFFER_GROUP'] = false;
        $arRow = array();
        foreach ($arSKUPropIDs as $propkey => $strOneCode) {
            $arCell = array(
                'VALUE' => 0,
                'SORT' => PHP_INT_MAX,
                'NA' => true
            );
            if (isset($arOffer['DISPLAY_PROPERTIES'][$strOneCode])) {
                $arMatrixFields[$strOneCode] = true;
                $arCell['NA'] = false;
                if ('directory' == $arSKUPropList[$strOneCode]['USER_TYPE']) {
                    $intValue = $arSKUPropList[$strOneCode]['XML_MAP'][$arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']];
                    $arCell['VALUE'] = $intValue;
                } elseif ('L' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE']) {
                    $arCell['VALUE'] = (int)$arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE_ENUM_ID'];
                } elseif ('E' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE']) {
                    $arCell['VALUE'] = (int)$arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE'];
                }
                $arCell['SORT'] = $arSKUPropList[$strOneCode]['VALUES'][$arCell['VALUE']]['SORT'];
            }
            $arRow[$strOneCode] = $arCell;
        }
        $arMatrix[$keyOffer] = $arRow;

        CIBlockPriceTools::setRatioMinPrice($arOffer, false);

        $arOffer['MORE_PHOTO'] = array();
        $arOffer['MORE_PHOTO_COUNT'] = 0;
        $offerSlider = CIBlockPriceTools::getSliderForItem($arOffer, $arParams['OFFER_ADD_PICT_PROP'], $arParams['ADD_DETAIL_TO_SLIDER'] == 'Y');
        if (empty($offerSlider)) {
            $offerSlider = $productSlider;
        }
        $arOffer['MORE_PHOTO'] = $offerSlider;
        $arOffer['MORE_PHOTO_COUNT'] = count($offerSlider);

        if (CIBlockPriceTools::clearProperties($arOffer['DISPLAY_PROPERTIES'], $arParams['OFFER_TREE_PROPS'])) {
            $boolSKUDisplayProps = true;
        }

        $arDouble[$arOffer['ID']] = true;
        $arNewOffers[$keyOffer] = $arOffer;
    }
    $arResult['OFFERS'] = $arNewOffers;
    $arResult['SHOW_OFFERS_PROPS'] = $boolSKUDisplayProps;

    $arUsedFields = array();
    $arSortFields = array();

    foreach ($arSKUPropIDs as $propkey => $strOneCode) {
        $boolExist = $arMatrixFields[$strOneCode];
        foreach ($arMatrix as $keyOffer => $arRow) {
            if ($boolExist) {
                if (!isset($arResult['OFFERS'][$keyOffer]['TREE']))
                    $arResult['OFFERS'][$keyOffer]['TREE'] = array();
                $arResult['OFFERS'][$keyOffer]['TREE']['PROP_' . $arSKUPropList[$strOneCode]['ID']] = $arMatrix[$keyOffer][$strOneCode]['VALUE'];
                $arResult['OFFERS'][$keyOffer]['SKU_SORT_' . $strOneCode] = $arMatrix[$keyOffer][$strOneCode]['SORT'];
                $arUsedFields[$strOneCode] = true;
                $arSortFields['SKU_SORT_' . $strOneCode] = SORT_NUMERIC;
            } else {
                unset($arMatrix[$keyOffer][$strOneCode]);
            }
        }
    }
    $arResult['OFFERS_PROP'] = $arUsedFields;
    $arResult['OFFERS_PROP_CODES'] = (!empty($arUsedFields) ? base64_encode(serialize(array_keys($arUsedFields))) : '');

    Collection::sortByColumn($arResult['OFFERS'], $arSortFields);

    $offerSet = array();
    if (!empty($arIDS) && CBXFeatures::IsFeatureEnabled('CatCompleteSet')) {
        $offerSet = array_fill_keys($arIDS, false);
        $rsSets = CCatalogProductSet::getList(
            array(),
            array(
                '@OWNER_ID' => $arIDS,
                '=SET_ID' => 0,
                '=TYPE' => CCatalogProductSet::TYPE_GROUP
            ),
            false,
            false,
            array('ID', 'OWNER_ID')
        );
        while ($arSet = $rsSets->Fetch()) {
            $arSet['OWNER_ID'] = (int)$arSet['OWNER_ID'];
            $offerSet[$arSet['OWNER_ID']] = true;
            $arResult['OFFER_GROUP'] = true;
        }
        if ($offerSet[$arResult['ID']]) {
            foreach ($offerSet as &$setOfferValue) {
                if ($setOfferValue === false) {
                    $setOfferValue = true;
                }
            }
            unset($setOfferValue);
            unset($offerSet[$arResult['ID']]);
        }
        if ($arResult['OFFER_GROUP']) {
            $offerSet = array_filter($offerSet);
            $arResult['OFFER_GROUP_VALUES'] = array_keys($offerSet);
        }
    }

    $arMatrix = array();
    $intSelected = -1;
    $arResult['MIN_PRICE'] = false;
    $arResult['MIN_BASIS_PRICE'] = false;
    foreach ($arResult['OFFERS'] as $keyOffer => $arOffer) {
        if (empty($arResult['MIN_PRICE']) && $arOffer['CAN_BUY']) {
            $intSelected = $keyOffer;
            $arResult['MIN_PRICE'] = (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']);
            $arResult['MIN_BASIS_PRICE'] = $arOffer['MIN_PRICE'];
        }
        $arSKUProps = false;
        if (!empty($arOffer['DISPLAY_PROPERTIES'])) {
            $boolSKUDisplayProps = true;
            $arSKUProps = array();
            foreach ($arOffer['DISPLAY_PROPERTIES'] as &$arOneProp) {
                if ('F' == $arOneProp['PROPERTY_TYPE'])
                    continue;
                $arSKUProps[] = array(
                    'NAME' => $arOneProp['NAME'],
                    'VALUE' => $arOneProp['DISPLAY_VALUE']
                );
            }
            unset($arOneProp);
        }
        if (isset($arOfferSet[$arOffer['ID']])) {
            $arOffer['OFFER_GROUP'] = true;
            $arResult['OFFERS'][$keyOffer]['OFFER_GROUP'] = true;
        }
        reset($arOffer['MORE_PHOTO']);
        $firstPhoto = current($arOffer['MORE_PHOTO']);
        $arOneRow = array(
            'ID' => $arOffer['ID'],
            'NAME' => $arOffer['~NAME'],
            'TREE' => $arOffer['TREE'],
            'PRICE' => (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']),
            'BASIS_PRICE' => $arOffer['MIN_PRICE'],
            'DISPLAY_PROPERTIES' => $arSKUProps,
            'PREVIEW_PICTURE' => $firstPhoto,
            'DETAIL_PICTURE' => $firstPhoto,
            'CHECK_QUANTITY' => $arOffer['CHECK_QUANTITY'],
            'MAX_QUANTITY' => $arOffer['CATALOG_QUANTITY'],
            'STEP_QUANTITY' => $arOffer['CATALOG_MEASURE_RATIO'],
            'QUANTITY_FLOAT' => is_double($arOffer['CATALOG_MEASURE_RATIO']),
            'MEASURE' => $arOffer['~CATALOG_MEASURE_NAME'],
            'OFFER_GROUP' => (isset($offerSet[$arOffer['ID']]) && $offerSet[$arOffer['ID']]),
            'CAN_BUY' => $arOffer['CAN_BUY'],
            'SLIDER' => $arOffer['MORE_PHOTO'],
            'SLIDER_COUNT' => $arOffer['MORE_PHOTO_COUNT'],
        );
        $arMatrix[$keyOffer] = $arOneRow;
    }
    if (-1 == $intSelected)
        $intSelected = 0;
    $arResult['JS_OFFERS'] = $arMatrix;
    $arResult['OFFERS_SELECTED'] = $intSelected;

    $arResult['OFFERS_IBLOCK'] = $arSKU['IBLOCK_ID'];
}

if ($arResult['MODULES']['catalog'] && $arResult['CATALOG']) {
    if ($arResult['CATALOG_TYPE'] == CCatalogProduct::TYPE_PRODUCT || $arResult['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET) {
        CIBlockPriceTools::setRatioMinPrice($arResult, false);
        $arResult['MIN_BASIS_PRICE'] = $arResult['MIN_PRICE'];
    }
    if (CBXFeatures::IsFeatureEnabled('CatCompleteSet') && $arResult['CATALOG_TYPE'] == CCatalogProduct::TYPE_PRODUCT) {
        $rsSets = CCatalogProductSet::getList(
            array(),
            array(
                '@OWNER_ID' => $arResult['ID'],
                '=SET_ID' => 0,
                '=TYPE' => CCatalogProductSet::TYPE_GROUP
            ),
            false,
            false,
            array('ID', 'OWNER_ID')
        );
        if ($arSet = $rsSets->Fetch()) {
            $arResult['OFFER_GROUP'] = true;
        }
    }
}

if (!empty($arResult['DISPLAY_PROPERTIES'])) {
    foreach ($arResult['DISPLAY_PROPERTIES'] as $propKey => $arDispProp) {
        if ('F' == $arDispProp['PROPERTY_TYPE'])
            unset($arResult['DISPLAY_PROPERTIES'][$propKey]);
    }
}

$arResult['SKU_PROPS'] = $arSKUPropList;
$arResult['DEFAULT_PICTURE'] = $arEmptyPreview;

$arResult['CURRENCIES'] = array();
if ($arResult['MODULES']['currency']) {
    if ($boolConvert) {
        $currencyFormat = CCurrencyLang::GetFormatDescription($arResult['CONVERT_CURRENCY']['CURRENCY_ID']);
        $arResult['CURRENCIES'] = array(
            array(
                'CURRENCY' => $arResult['CONVERT_CURRENCY']['CURRENCY_ID'],
                'FORMAT' => array(
                    'FORMAT_STRING' => $currencyFormat['FORMAT_STRING'],
                    'DEC_POINT' => $currencyFormat['DEC_POINT'],
                    'THOUSANDS_SEP' => $currencyFormat['THOUSANDS_SEP'],
                    'DECIMALS' => $currencyFormat['DECIMALS'],
                    'THOUSANDS_VARIANT' => $currencyFormat['THOUSANDS_VARIANT'],
                    'HIDE_ZERO' => $currencyFormat['HIDE_ZERO']
                )
            )
        );
        unset($currencyFormat);
    } else {
        $currencyIterator = CurrencyTable::getList(array(
            'select' => array('CURRENCY')
        ));
        while ($currency = $currencyIterator->fetch()) {
            $currencyFormat = CCurrencyLang::GetFormatDescription($currency['CURRENCY']);
            $arResult['CURRENCIES'][] = array(
                'CURRENCY' => $currency['CURRENCY'],
                'FORMAT' => array(
                    'FORMAT_STRING' => $currencyFormat['FORMAT_STRING'],
                    'DEC_POINT' => $currencyFormat['DEC_POINT'],
                    'THOUSANDS_SEP' => $currencyFormat['THOUSANDS_SEP'],
                    'DECIMALS' => $currencyFormat['DECIMALS'],
                    'THOUSANDS_VARIANT' => $currencyFormat['THOUSANDS_VARIANT'],
                    'HIDE_ZERO' => $currencyFormat['HIDE_ZERO']
                )
            );
        }
        unset($currencyFormat, $currency, $currencyIterator);
    }
}


$arFilter = array(
    'IBLOCK_ID' => 4,
    'ACTIVE' => 'Y',
    '>DEPTH_LEVEL' => 0,
    'ID' => intval($arResult ['PROPERTIES'] ['MANUFACTURER'] ['VALUE'])
);
if ($manufacturer = CIBlockSection::GetList(array(), $arFilter, false, array(
    'ID',
    'IBLOCK_ID',
    'NAME',
    'CODE',
    'PICTURE',
    'DETAIL_PICTURE',
    'UF_COUNTRY',
    'UF_RATE',
    'DESCRIPTION',
    'SECTION_PAGE_URL'
))->Fetch()) {
    $country = CIBlockSection::GetByID($manufacturer ['UF_COUNTRY'])->Fetch();
    $arResult ['PROPERTIES'] ['MANUFACTURER'] ['CODE'] = $manufacturer ['CODE'];
    $arResult ['PROPERTIES'] ['MANUFACTURER'] ['UF_COUNTRY'] = $country ['NAME'];
    $arResult ['PROPERTIES'] ['MANUFACTURER'] ['UF_COUNTRY_FLAG'] = $country ['CODE'];
    $arResult ['PROPERTIES'] ['MANUFACTURER'] ['VALUE'] = $manufacturer ['NAME'];
    $arResult ['PROPERTIES'] ['MANUFACTURER'] ['UF_RATE'] = (int)$manufacturer ['UF_RATE'];
    $arResult ['PROPERTIES'] ['MANUFACTURER'] ['UF_RATE'] = (empty($arResult ['PROPERTIES'] ['MANUFACTURER'] ['UF_RATE'])) ? 4 : $arResult ['PROPERTIES'] ['MANUFACTURER'] ['UF_RATE'];

    $thumb = CFile::ResizeImageGet($manufacturer ['PICTURE'], array('width' => 126, 'height' => 81), BX_RESIZE_IMAGE_PROPORTIONAL, true);

    $arResult ['PROPERTIES'] ['MANUFACTURER'] ['PICTURE'] = $thumb;
    $arResult ['PROPERTIES'] ['MANUFACTURER'] ['DESCRIPTION'] = $manufacturer ['DESCRIPTION'];
}
$res = CIBlockElement::GetByID($arResult ['PROPERTIES'] ['COLLECTION_REF'] ['VALUE']);
if ($ar_res = $res->GetNext()) {

    $arResult ['PROPERTIES'] ['COLLECTION_REF']['PREVIEW_TEXT'] = $ar_res ['PREVIEW_TEXT'];
    $arResult ['PROPERTIES'] ['COLLECTION_REF']['DETAIL_TEXT'] = $ar_res ['DETAIL_TEXT'];
    $arResult ['PROPERTIES'] ['COLLECTION_REF'] ['VALUE'] = $ar_res ['NAME'];
    $arResult ['PROPERTIES'] ['COLLECTION_REF'] ['LINK'] = $ar_res ['DETAIL_PAGE_URL'];
    $arResult ['PROPERTIES'] ['COLLECTION_REF']['TAGS'] = $ar_res ['TAGS'];
}


if (!empty($arResult ['PROPERTIES']['complect']['VALUE'])) {
    $arFilter = array(
        'IBLOCK_ID' => 11,
        'ACTIVE' => 'Y',
        'ID' => $arResult['PROPERTIES']['complect']['VALUE']
    );
    $arSelect = array(
        'ID',
        'NAME',
        'DETAIL_PICTURE',
        'DETAIL_PAGE_URL',
        'CATALOG_GROUP_' . $arResult["PRICES_ALLOW"][0]
    );
    $rs = CIBlockElement::GetList(array("SORT" => "ASC", "ID" => "ASC"), $arFilter, false, false, $arSelect);

    while ($complect = $rs->GetNext()) {
        if (!empty($complect["DETAIL_PICTURE"])) {
            $complect["DETAIL_PICTURE_FULL"] = CFile::GetFileArray($complect["DETAIL_PICTURE"]);
            $complect["DETAIL_PICTURE"] = CFile::ResizeImageGet($complect["DETAIL_PICTURE"], array('width' => 200, 'height' => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        } else {
            $complect["DETAIL_PICTURE"] = $arEmptyPreview;
        }
        $complect["PRICE"]["VALUE"] = $complect["CATALOG_PRICE_" . $arResult["PRICES_ALLOW"][0]];
        $complect["PRICE"]["CURRENCY"] = $complect["CATALOG_CURRENCY_" . $arResult["PRICES_ALLOW"][0]];
        $complect["PRICE"]["PRINT_VALUE"] = CurrencyFormat($complect["PRICE"]["VALUE"], $complect["PRICE"]["CURRENCY"]);
        // если цена не в рублях то будем ее переводить в рубли
        if ($complect["PRICE"]["CURRENCY"] != "RUB") {
            $newPrice = CCurrencyRates::ConvertCurrency($complect["PRICE"]["VALUE"], $complect["PRICE"]["CURRENCY"], "RUB");
            $complect["PRICE"]["VALUE"] = $newPrice;
            $complect["PRICE"]["CURRENCY"] = "RUB";
            $complect["CATALOG_PRICE_" . $arResult["PRICES_ALLOW"][0]] = $newPrice;
            $complect["CATALOG_CURRENCY_" . $arResult["PRICES_ALLOW"][0]] = "RUB";
            $complect["PRICE"]["PRINT_VALUE"] = CurrencyFormat($newPrice, $complect["PRICE"]["CURRENCY"]);
        }
        //convertPrice($complect["PRICE"]);

        $arResult ['PROPERTIES']['complect']["V"][] = $complect;
    }
}


if (!empty($arResult['PROPERTIES']['complect_main']['VALUE'])) {
    $arFilter = array(
        'IBLOCK_ID' => 11,
        'ACTIVE' => 'Y',
        'ID' => $arResult['PROPERTIES']['complect_main']['VALUE']
    );
    $arSelect = array(
        'ID',
        'NAME',
        'DETAIL_PICTURE',
        'CATALOG_GROUP_' . $arResult["PRICES_ALLOW"][0]
    );
    $rs = CIBlockElement::GetList(array("SORT" => "ASC", "ID" => "ASC"), $arFilter, false, false, $arSelect);

    while ($complect = $rs->GetNext()) {
        if (!empty($complect["DETAIL_PICTURE"])) {
            $complect["DETAIL_PICTURE"] = CFile::ResizeImageGet($complect["DETAIL_PICTURE"], array('width' => 132, 'height' => 132), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        } else {
            $complect["DETAIL_PICTURE"] = $arEmptyPreview;
        }
        $complect["PRICE"]["VALUE"] = $complect["CATALOG_PRICE_" . $arResult["PRICES_ALLOW"][0]];
        $complect["PRICE"]["CURRENCY"] = $complect["CATALOG_CURRENCY_" . $arResult["PRICES_ALLOW"][0]];
        // если цена не в рублях то будем ее переводить в рубли
        if ($complect["PRICE"]["CURRENCY"] != "RUB") {
            $newPrice = CCurrencyRates::ConvertCurrency($complect["PRICE"]["VALUE"], $complect["PRICE"]["CURRENCY"], "RUB");
            $complect["PRICE"]["VALUE"] = $newPrice;
            $complect["PRICE"]["CURRENCY"] = "RUB";
            $complect["CATALOG_PRICE_" . $arResult["PRICES_ALLOW"][0]] = $newPrice;
            $complect["CATALOG_CURRENCY_" . $arResult["PRICES_ALLOW"][0]] = "RUB";

        }

        //convertPrice($complect["PRICE"]);

        $arResult ['PROPERTIES']['complect_main']["V"][] = $complect;
    }
}

if (!empty($arResult['PROPERTIES']['color']['VALUE'])/* && empty($arResult['PROPERTIES']['other_colors']['VALUE'])*/) {

    $arFilter = array(
        'IBLOCK_ID' => $arResult["IBLOCK_ID"],
        'ACTIVE' => 'Y',
        'PROPERTY_other_colors' => $arResult['ID']
    );
    $arSelect = array(
        'ID',
        'NAME',
        'IBLOCK_ID'
    );

    $rs = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);

    $d = array();
    while ($ob = $rs->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        if (!empty($arProps['other_colors']['VALUE']) && count($arProps['other_colors']['VALUE']) > count($arResult['PROPERTIES']['other_colors']['VALUE'])) {
            array_unshift($arProps['other_colors']['VALUE'], $arFields["ID"]);

            $arResult['PROPERTIES']['other_colors']['VALUE'] = $arProps['other_colors']['VALUE'];
        }
    }

    if (!in_array($arResult["ID"], $arResult['PROPERTIES']['other_colors']['VALUE'])) {
        $arResult['PROPERTIES']['other_colors']['VALUE'][] = $arResult["ID"];
    }

    $d = $arResult['PROPERTIES']['other_colors']['VALUE'];
    sort($d);
    $arResult['PROPERTIES']['other_colors']['VALUE'] = $d;
}

if (!empty($arResult['PROPERTIES']['other_colors']['VALUE'])) {
    $arFilter = array(
        'IBLOCK_ID' => $arResult["IBLOCK_ID"],
        'ACTIVE' => 'Y',
        'ID' => $arResult['PROPERTIES']['other_colors']['VALUE']
    );
    $arSelect = array(
        'ID',
        'NAME',
        'DETAIL_PAGE_URL',
        'PROPERTY_color'
    );

    $rs = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

    $arResult ['PROPERTIES']['other_colors']["V"] = array();
    $found = false;
    while ($other = $rs->GetNext()) {
        if ($other["ID"] == $arResult["ID"]) {
            $found = true;
            unset($other["DETAIL_PAGE_URL"]);
        }
        $arResult ['PROPERTIES']['other_colors']["V"][] = $other;
    }

    if (!$found) {
        $self = array("NAME" => $arResult["NAME"], "PROPERTY_COLOR_VALUE" => $arResult['PROPERTIES']['color']['VALUE']);
        array_unshift($arResult ['PROPERTIES']['other_colors']["V"], $self);
    }
}

if (!empty($arResult['PROPERTIES']['size']['VALUE'])) {

    $arFilter = array(
        'IBLOCK_ID' => $arResult["IBLOCK_ID"],
        'ACTIVE' => 'Y',
        'PROPERTY_other_sizes' => $arResult['ID']
    );
    $arSelect = array(
        'ID',
        'NAME',
        'IBLOCK_ID'
    );

    $rs = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

    $d = array();
    while ($ob = $rs->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();

        if (!empty($arProps['other_sizes']['VALUE']) && count($arProps['other_sizes']['VALUE']) >= count($arResult['PROPERTIES']['other_sizes']['VALUE'])) {
            array_unshift($arProps['other_sizes']['VALUE'], $arFields["ID"]);

            $arResult['PROPERTIES']['other_sizes']['VALUE'] = $arProps['other_sizes']['VALUE'];
        }
    }

    if (!in_array($arResult["ID"], $arResult['PROPERTIES']['other_sizes']['VALUE'])) {
        $arResult['PROPERTIES']['other_sizes']['VALUE'][] = $arResult["ID"];
    }

    $d = $arResult['PROPERTIES']['other_sizes']['VALUE'];
    sort($d);
    $arResult['PROPERTIES']['other_sizes']['VALUE'] = $d;
}

if (!empty($arResult['PROPERTIES']['other_sizes']['VALUE'])) {
    $arFilter = array(
        'IBLOCK_ID' => $arResult["IBLOCK_ID"],
        'ACTIVE' => 'Y',
        'ID' => $arResult['PROPERTIES']['other_sizes']['VALUE']
    );
    $arSelect = array(
        'ID',
        'NAME',
        'DETAIL_PAGE_URL',
        'PROPERTY_size'
    );

    $rs = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

    $arResult ['PROPERTIES']['other_sizes']["V"] = array();
    $found = false;
    while ($other = $rs->GetNext()) {
        if ($other["ID"] == $arResult["ID"]) {
            $found = true;
            unset($other["DETAIL_PAGE_URL"]);
        }
        $arResult ['PROPERTIES']['other_sizes']["V"][] = $other;
    }

    if (!$found) {
        $self = array("NAME" => $arResult["NAME"], "PROPERTY_SIZE_VALUE" => $arResult['PROPERTIES']['size']['VALUE']);
        array_unshift($arResult ['PROPERTIES']['other_sizes']["V"], $self);
    }
}

$res = CIBlockElement::GetByID($arResult['PROPERTIES']['product1']['VALUE']);
if ($ar_res = $res->GetNext()) {
    $arResult['PROPERTIES']['product1']['VALUE'] = $ar_res;
}

if (empty($arResult['PROPERTIES']['name_full']['VALUE'])) {
    $arResult['PROPERTIES']['name_full']['VALUE'] = $arResult['NAME'];
}
if (!is_array($arResult['PROPERTIES']['dop_pictures']['VALUE'])) {
    $maxWidth = 148;
    $maxHeight = 148;
    foreach ($arResult['PROPERTIES']['dop_pictures']['VALUE'] as &$v) {
        $v = CFile::GetFileArray($v);

        if ($v["WIDTH"] > $maxWidth)
            $v['trumb'] = CFile::ResizeImageGet($v["ID"], array('width' => $maxWidth, 'height' => $maxHeight), BX_RESIZE_IMAGE_EXACT, true);
    }
}

//slider
$rs = CIBlockElement::GetList(array("sort" => "asc", "name" => "asc"), array("IBLOCK_ID" => 12, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "DETAIL_TEXT"));
$arResult["TextSlider"] = array();
while ($arFields = $rs->GetNext()) {
    $arResult["TextSlider"][] = $arFields;
}


$arResult["componentPath"] = $this->GetFolder();


if ($arResult['PROPERTIES']['price_real']['VALUE'] > $arResult['PROPERTIES']['price']['VALUE']) {
    $arResult['p_no_discount'] = round(CCurrencyRates::ConvertCurrency($arResult['PROPERTIES']['price_real']['VALUE'], $arResult['PROPERTIES']['currency']['VALUE_XML_ID'], 'RUB'));
} else {
    $arResult['p_no_discount'] = 0;
}


if ($arResult['PROPERTIES']['COLLECTION_REF']['~VALUE'] && $arResult['PROPERTIES']['USE_COLLECTION_VIDEO']['VALUE'] == 'Да') {
    $arColFilter = Array(
        "IBLOCK_ID" => 4,
        "ID" => $arResult['PROPERTIES']['COLLECTION_REF']['~VALUE'],
    );

    $colitems = CIBlockElement::GetList(array(), $arColFilter, false, false, Array("ID", "PROPERTY_VIDEO"));
    while ($obColItem = $colitems->GetNextElement()) {
        $arElemField = $obColItem->GetFields();

        $YoutubeCode = $arElemField["PROPERTY_VIDEO_VALUE"];
        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $YoutubeCode, $matches);
        if (isset($matches[2]) && $matches[2] != '') {
            $YoutubeCode = $matches[2];
        }
        $arResult["YOUTUBE_CODE"] = $YoutubeCode;
    }
} else {
    if (!empty($arResult['PROPERTIES']['video']['VALUE'])):
        $YoutubeCode = $arResult['PROPERTIES']['video']['VALUE'];
        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $YoutubeCode, $matches);
        if (isset($matches[2]) && $matches[2] != '') {
            $YoutubeCode = $matches[2];
        }
        $arResult['YOUTUBE_CODE'] = $YoutubeCode;
    endif;
}


$rsCrumbs = CIBlockSection::GetNavChain($arParams['IBLOCK_ID'], $arResult['IBLOCK_SECTION_ID']);
while ($arCrumb = $rsCrumbs->GetNext()) {
    $arResult['CRUMBS'][] = array(
        'ID' => $arCrumb['ID'],
        'NAME' => $arCrumb['NAME'],
        'LINK' => $arCrumb['SECTION_PAGE_URL']
    );
}

$arResult['CRUMBS'][] = array(
    'ID' => $arResult['ID'],
    'NAME' => $arResult['NAME'],
    'LINK' => ''
);

// is this product at favorite
$arResult['IS_IN_FAVORITE'] = 'N';
$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
        "DELAY" => "Y",
        "PRODUCT_ID" => $arResult['ID']
    ),
    false,
    false,
    array("ID")
);

while ($arBasketItem = $dbBasketItems->Fetch()) {
    if (!empty($arBasketItem['ID'])) {
        $arResult['IS_IN_FAVORITE'] = 'Y';
    }
}

?>