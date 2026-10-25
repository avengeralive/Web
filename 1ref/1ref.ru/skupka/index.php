<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Cкупка");
?>
<div class="page page-skupka">
    <div class="page-body">
        <div class="container">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID
                )
            ); ?>
            <div class="skupka"></div>
        </div>
    </div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>