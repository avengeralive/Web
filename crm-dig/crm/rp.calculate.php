<?php require_once 'include.config.php';

/**
 *
 * Точка входа для интеграции Почты России с RetailCRM для расчета стоимости
 *
 */

const LOGGING = true;
const CALC_AUTH = 'SXzSXabcI2NfbeY4uyBI8Y99jk1Sgh5K';
const CALC_USER = 'Z2xvcml5YWxhYmlyaW50QGJrLnJ1Okdsb3JsYWJjaGVtNjY1';

$date = date('Y-m-d H:i:s');
$request = print_r($_REQUEST, true);

$data = json_decode($_REQUEST['calculate'], true);
$clientId = $_REQUEST['clientId'];

$log = "$date =========================================\n$request\n";

try {

    $zip = empty($data['deliveryAddress']['index']) ? '' : $data['deliveryAddress']['index'];

    if ($zip == '') throw new Exception('Ошибка: для расчета необходимо заполнить почтовый индекс.');

    $package = $data['packages'][0];
    $weight = $package['weight'];
    $length = $package['length'];
    $width = $package['width'];
    $height = $package['height'];

    $cod = $data['cod'];
    $ins = $data['declaredValue'];

    $result = [
        'success' => true,
        'result' => [],
    ];

    // 2021.04.08 Для digital не предоставляем тариф "Посылка 1 класса"
    $tariffs = ($clientId == 'digital') ? RP::$tariffsNoFirst : RP::$tariffs;

    foreach ($tariffs as $code => $description) {

        $log .= $code.PHP_EOL;
        $post = RP::calculateTariff($zip, $weight, $ins, $code, CALC_AUTH, CALC_USER, $log);
        $log .= "     ".RP::json_print($post, true);

        $sum = isset($post['total-rate']) ? $post['total-rate'] : 0;
        if ($sum > 0) {

            $sum += $post['total-vat'];

            $max = isset($post['delivery-time']['max-days']) ? $post['delivery-time']['max-days'] : '?';
            $min = isset($post['delivery-time']['min-days']) ? $post['delivery-time']['min-days'] : $max;

            $result['result'][] = [
                'code' => $code,
                'group' => 'Почта России',
                'name' => $description,
                'type' => 'courier',
                'description' => 'Почта России - ' . $description,
                'cost' => $sum / 100,
                'minTerm' => $min,
                'maxTerm' => $max,
            ];

        }

    }

}
catch (Exception $e) {

    $result = [
        'success' => false,
        'errorMsg' => $e->getMessage(),
    ];

}

$log .= "return - ".RP::json_print($result)."\n\n\n\n";

if (LOGGING) file_put_contents('rp.calculate.log', $log, FILE_APPEND);

echo json_encode($result);
