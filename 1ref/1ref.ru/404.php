<? include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->AddChainItem('404');
?>
    <div class="page page-main">
        <div class="section">
            <div class="container">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => SITE_ID
                    )
                ); ?>
                <h1 class="page-title section-title"><? $APPLICATION->ShowTitle(false); ?></h1>
                <div class="page-body">
                    <div class="content-text">
                        <p>Неправильно набран адрес, <br>или такой страницы на сайте больше не существует.
                        <p>Вернитесь на <a href="<?= SITE_DIR ?>">главную</a> или воспользуйтесь картой сайта.
                    </div>
                </div>
            </div>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>