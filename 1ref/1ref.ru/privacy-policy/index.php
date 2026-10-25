<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Политика конфиденциальности");
?>
<div class="page page-about">
    <div class="section">
        <div class="container">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID
                )
            ); ?>
            <h1 class="page-title section-title"><? $APPLICATION->ShowTitle(false); ?></h1>
            <div class="page-with-sidebar">
                <div class="page-body">
                    <div class="content-text">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/include/private/content.php"
                        )); ?>
                    </div>
                </div>
                <?/* $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/sidebar.php"
                )); */?>
            </div>
        </div>
    </div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
