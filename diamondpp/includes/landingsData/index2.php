<?php

session_start();
session_set_cookie_params(60 * 60 * 24 * 60);

global $offer;
include_once $_SERVER['DOCUMENT_ROOT'] . '/../includes/landingsData/index3.php'; 
$base_url = '';
$api = new LandingsData();
$short_country = $api->getCountryCode();
$price = $api->getPrice($offer);
$_user_country = $api->getCountryCode();
Registry::set('_user_country', $_user_country);

if (isset($_GET['stream']) && $_GET['stream'] != '' && $_GET['stream'] != '0') {
    $_SESSION['stream'] = htmlentities($_GET['stream']);
    $stream = htmlentities($_GET['stream']);
    $metrika = $api->getMetrika($stream);
	$google = $api->getGoogle($stream);
    $mail_id = $api->get_mail_id($stream);
    $vk = $api->vk($stream);
    $facebook = $api->facebook($stream);
    $directadvert = $api->directadvert($stream);
    $users_online_top = $api->get_users_online_top($stream);
    $count_orders_right = $api->get_count_orders_right($stream);
    $delivery = $api->get_delivery($stream);
    $users_online_left = $api->get_users_online_left($stream);
    $price_right = $api->get_price_right($stream);
    $comebacker = $api->comebacker($stream);
    if (isset($_GET['amp;stats']))
        $_GET['stats'] = $_GET['amp;stats'];
}


// Если был переход по партнерской ссылке выданной вебмастеру в личном кабинете
// If there was a transition on affiliate link webmaster issued in a private office
if ((isset($_GET['stats']) && $_GET['stats'] != '' && $_GET['stats'] != '0')) {

    // Подключаем файл конфигурации
    // Connect configuration file
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../includes/config.php';

    // Подключаем файл защиты от инжекта для передаваемых переменных
    // Connect the protection of Injection file transmitted variables
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../includes/antiinject/index.php';

    // Подключаем функции кодирования и раскодирования партнерской строки
    // Connect the encoding and decoding functions affiliate line
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../includes/partnerstroka/index.php';

    // Подключаем необходимые библиотеки
    // Connect the required libraries
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../modules/count/index.php';
    
}
/*
// Если был переход по ссылке субаккаунта выданной вебмастеру в личном кабинете
// If there was a transition to the link subaccount webmaster issued in a private office
if (isset($_GET['stream']) && $_GET['stream'] != '' && $_GET['stream'] != '0') {

    // Подключаем файл конфигурации
    // Connect configuration file
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../includes/config.php';

    // Подключаем файл защиты от инжекта для передаваемых переменных
    // Connect the protection of Injection file transmitted variable
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../includes/antiinject/index.php';

    // Подключаем функции кодирования и раскодирования партнерской строки
    // Connect the encoding and decoding functions affiliate line
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../includes/partnerstroka/index.php';

    // Подключаем необходимые библиотеки
    // Connect the required libraries
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../modules/count/index.php';
}
*/

if (isset($_GET['stats']) && $_GET['stats'] != '' && $_GET['stats'] != '0') {
    //$_SESSION['code'] = htmlentities($_GET['stats']);
}

function buff($content) {
    $bom = pack('H*', 'EFBBBF');
    $content = preg_replace("/^$bom/", '', $content);


    $content = str_replace('<body', '<script type="text/javascript">

if(!window.jQuery){
document.write(unescape(\'<script type="text/javascript" src="http:///jquery-3.3.1.min.js">%3C/script%3E\'));
}
</script><body', $content);

    $content = str_replace('</body>', '<script type="text/javascript" src="http://avaleads.pro/offers/assets/js/plugins.js"></script><script src="//api-maps.yandex.ru/2.0/?load=package.standard&amp;lang=ru-RU" type="text/javascript"></script></body>', $content);

    global $metrika;
    global $mail_id;
	global $google;
    global $vk;
    global $facebook;
    global $price;
    global $short_country;
    global $directadvert;
    global $users_online_top;
    global $price_right;
    global $count_orders_right;
    global $delivery;
    global $users_online_left;
    global $comebacker;

    if (isset($metrika) && $metrika != '') {
        $content = str_replace('</body>', $metrika . "</body>", $content);
    }
    if (isset($metrika) && $metrika != '') {
        $content = str_replace('</body>', $google . "</body>", $content);
    }
    if (isset($mail_id) && $mail_id != '') {
        $content = str_replace('</body>', $mail_id . "</body>", $content);
    }
    if (isset($vk) && $vk != '') {
        $content = str_replace('</body>', $vk . "</body>", $content);
    }
    if (isset($facebook) && $facebook != '') {
        $content = str_replace('</body>', $facebook . "</body>", $content);
    }
    if (isset($directadvert) && $directadvert != '') {
        $content = str_replace('</body>', $directadvert . "</body>", $content);
    }
    $uc = Registry::get('_user_country');
    $content = str_replace('</body', '<script id=_smartForm data-country="' . $uc . '" src="http://avaleads.pro/offers/assets/js/smartForm.js"></script></body', $content);

    if ($users_online_top == 1 or $price_right == 1 or $count_orders_right == 1 or $delivery == 1 or $users_online_left == 1 or $comebacker == 1) {

        $script = '
				<script>
					$(document).ready(function () {
				';

        if (!empty($users_online_top) && $users_online_top == 1) {
            $script .= 'addTopLine();';
        }
        if (!empty($price_right) && $price_right == 1) {
            $script .= 'freezeMoney("' . $short_country . '");';
        }
        if (!empty($count_orders_right) && $count_orders_right == 1) {
            $script .= 'new showTips("сумму " + "' . $price['real_price'] . '", "сумму "+ "' . $price['real_price'] . '");';
        }
        if (!empty($delivery) && $delivery == 1) {
            $script .= 'new addDeliveryPopup();';
        }
        if (!empty($users_online_left) && $users_online_left == 1) {
            $script .= 'showSwimmer();';
        }
        $script .= '
					});
				</script>
				';

        if (!empty($comebacker) && $comebacker == 1) {


            $comebackScript .=
                    '
			<script>
			$( document ).ready( function(){
				$("a").click(function(){
					var id=$(this).attr("id");
					if(window.hasOwnProperty("locks") && window.locks.hasOwnProperty(id) && document.getElementById(window.locks[id])) {

						if(document.getElementById(window.locks[id]).value.length>0) {
							window.onbeforeunload = null;
							return true;
						}
					} else {
						window.onbeforeunload = null;
						return true;
					}
				});

				window.onbeforeunload = function (){
					
					return "******************\nВы уверены что хотите покинуть страницу?\n******************\nПредложение со скидкой скоро закончится!";
				};
			});
			</script>
			';
            $content = str_replace('</body>', $comebackScript . "</body>", $content);
        }

        $content = str_replace('</body>', $script . "</body>", $content);
    }
    if (0 && !isset($_GET['nosmall']))
        $content = trim(preg_replace('/\s+/', ' ', $content));
    return $content;
}

//var_dump($_SESSION);
ob_start('buff');
//ob_start('ob_gzhandler');
?>