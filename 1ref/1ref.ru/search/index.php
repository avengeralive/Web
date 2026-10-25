<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Поиск');
?>
<? $APPLICATION->IncludeComponent("palladiumlab:search", "main", [
    'IBLOCK_CODE' => $iblockCode ?? '',
    'CATALOGS' => [
        IBLOCK_REFCATALOG_ID,
    ],
]); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
