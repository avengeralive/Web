<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<div class="page page-cart">
    <div class="page-body">
        <div class="container">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID
                )
            ); ?>
            <div class="cart-wrapp">
                <h1 class="cart-title section-title h1"><? $APPLICATION->ShowTitle(false); ?></h1>
                <?php $APPLICATION->IncludeComponent("palladiumlab:basket", "main"); ?>
            </div>
        </div>
    </div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
