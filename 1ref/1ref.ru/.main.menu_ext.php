<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "ID" => $_REQUEST["ID"],
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => IBLOCK_REFCATALOG_ID,
        "SECTION_URL" => "/#SECTION_CODE_PATH#/",
        "DEPTH_LEVEL" => "4",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000"
    )
) ?: [];
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
