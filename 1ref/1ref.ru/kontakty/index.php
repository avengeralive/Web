<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<div class="page page-kontakty">
    <div class="page-body">
        <div class="container">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID
                )
            ); ?>
            <div class="kontakty"></div>
        </div>
    </div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>