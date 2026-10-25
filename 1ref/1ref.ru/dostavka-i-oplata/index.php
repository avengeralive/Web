<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Доставка и оплата");
?>
<div class="page page-dostavka_i_oplata">
    <div class="page-body">
        <div class="container">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID
                )
            ); ?>
            <div class="dostavka_i_oplata"></div>
        </div>
    </div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>