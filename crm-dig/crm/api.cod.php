<?php require_once 'include.config.php';
/** @var mysqli $db */

/**
 * Точка входа для триггера RetailCRM для добавления заказа в контроль наложенного платежа
 *
 */

const LOGGING = false;

$account = !empty($_REQUEST['account']) ? (string)$_REQUEST['account'] : null;
$number = !empty($_REQUEST['number']) ? (string)$_REQUEST['number'] : null;
$status = !empty($_REQUEST['status']) ? (string)$_REQUEST['status'] : '';
$barcode = !empty($_REQUEST['barcode']) ? (string)$_REQUEST['barcode'] : null;
$cod = floatval(!empty($_REQUEST['cod']) ? $_REQUEST['cod'] : 0);
$cod_receiver = strval(!empty($_REQUEST['cod_receiver']) ? $_REQUEST['cod_receiver'] : '');
$date_shipped = !empty($_REQUEST['date_shipped']) ? (string)$_REQUEST['date_shipped'] : null;
$date_delivered = !empty($_REQUEST['date_delivered']) ? (string)$_REQUEST['date_delivered'] : null;
$date = date('Y-m-d H:i:s');

if (LOGGING) {
//    file_put_contents('retail.push.log', print_r($_REQUEST, true).PHP_EOL, FILE_APPEND);
    file_put_contents('retail.cod.log', "$date - '$account', '$number', '$barcode', '$cod', '$status', '$date_shipped', '$date_delivered', '$cod_receiver'\n", FILE_APPEND);
}

if (($account != '') && ($number != '') && ($status != '') && ($barcode != '')) {

    $account = $db->real_escape_string($account);
    $number = $db->real_escape_string($number);
    $date_shipped = $db->real_escape_string($date_shipped);
    $date_delivered = $db->real_escape_string($date_delivered);
    $barcode = $db->real_escape_string($barcode);

//    $cod_receiver = $db->real_escape_string(isset(RP::$cod_receivers[$cod_receiver+1]) ? RP::$cod_receivers[$cod_receiver+1] : '');

    if ($status == 'delivering') {

        // Прилетел новый заказ из ритейл, запишем в базе

        $db->query("insert into cod(account, number, barcode, date_shipped, status, cod, cod_receiver) values ('$account', '$number', '$barcode', '$date_shipped', 0, '$cod', '$cod_receiver')");


    }
    elseif (($status == 'complete') && ($date_delivered)) {

        $date_delivered = date('Y-m-d', strtotime($date_delivered));

        // Из ритейла пришла информация, что заказ был доставлен - запишем в базу дату доставки заказа

        // Проверим, загружен ли такой заказ ранее
        $old = $db->query("select * from cod where number='$number'")->fetch_assoc();
        if ($old) {

            // Заказ ранее уже был загружен - обновим статус и дату доставки
            $db->query("update cod set date_delivered='$date_delivered', status=1, cod_receiver='$cod_receiver' where number='$number'");
        }
        else {

            // Не нашли такой заказ - сохраним в базу, как доставленный
            $db->query("insert into cod(account, number, barcode, date_shipped, date_delivered, status, cod, cod_receiver) values ('$account', '$number', '$barcode', '$date_shipped', '$date_delivered', 1, '$cod', '$cod_receiver')");

        }




    }

}
