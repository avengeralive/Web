<?php require_once 'include.config.php';

/**
 * Точка входа для триггера RetailCRM для обработки изменения статусов заказов
 *
 */

const LOGGING = false;
const ACTIVE_KEYTARO = false;
const ACTIVE_WEIGHT = false;
const ACTIVE_STOCK = false;

$account = !empty($_REQUEST['account']) ? (string)$_REQUEST['account'] : '';
$order_id = !empty($_REQUEST['id']) ? (string)$_REQUEST['id'] : '';
$status = !empty($_REQUEST['status']) ? (string)$_REQUEST['status'] : '';
$site = !empty($_REQUEST['site']) ? (string)$_REQUEST['site'] : '';
$date = date('Y-m-d H:i:s');

if (LOGGING) {
    if ($account == 'ava-med24') file_put_contents('retail.push.log', print_r($_REQUEST, true).PHP_EOL, FILE_APPEND);
    file_put_contents('retail.push.log', "$date - '$account', '$order_id', '$status', '$site'\n\n", FILE_APPEND);
}

if (($account != '') && ($order_id != '') && ($status != '')) {

    // Увеличения веса заказа в avamed при наступлении статуса send-to-assembling
    if (ACTIVE_WEIGHT && ($account == 'ava-med24') && ($status == 'send-to-assembling')) {
        $weight = intval(!empty($_REQUEST['weight']) ? $_REQUEST['weight'] : 0);

        $weight += 120; // TODO добавляемый вес вынести в настройки

        // Записываем заказ обратно в ритейл
        $url ="https://ava-med24.retailcrm.ru/api/v5/orders/$order_id/edit?apiKey=CwtSZrWcftHjsFQ9Y6Jegp3AboOrZWpZ";

        $order = [
            'weight' => $weight,
        ];

        $data = [
            'order' => json_encode($order),
            'by' => 'id',
            'site' => $site,
        ];

        if (LOGGING) file_put_contents('retail.push.log', RP::json_print($data, true)."\n\n", FILE_APPEND);

        $result = json_decode(RP::sendPostRequest($url, http_build_query($data)));

        if (LOGGING) file_put_contents('retail.push.log', RP::json_print($result, true)."\n\n", FILE_APPEND);

    }

    // Передача данных в Keytaro
    if (ACTIVE_KEYTARO) {
        $order_id = $db->real_escape_string($order_id);
        $order = $db->query("select * from orders where retail_id=$order_id")->fetch_assoc();

        // Кейтаро
        $subid = !empty($order['sid']) ? $order['sid'] : '';
        if ($subid) {

            // Отправим в Кейтаро постбэк
            $params = [
                'subid' => $subid,
                'status' => $status,
                'lead_status' => 'no-calling,new,no-calling1,no-calling2,no-calling3,no-calling4,no-calling1day,no-calling2day,no-calling3day,perezvoniy-pozge,address-search',
                'sale_status' => 'send-to-assembling,availability-confirmed,complete,availability-confirmed-night,transferred-bp,delivering,temporary-storage,temporary-storage-dop,return,transfererror-bp,pvz',
                'rejected_status' => 'no-product,already-buyed,delyvery-did-not-suit,prices-did-not-suit,dorogo,podumaet,cancel-other,opis,prochee,ne-original,otzivi,fraud,kurier,auto-spam,dublicat-na-udalenie,spam',
            ];

            $url = 'http://172.105.75.107/5ca51f0/postback?'.http_build_query($params);

            $keytaro = file_get_contents($url);

            file_put_contents('keytaro.push.log', "$date\n$url\n$keytaro\n\n", FILE_APPEND);

        }
    }

    // Списание товаров с остатков
    if (ACTIVE_STOCK && ($account == 'ava-med24') && in_array($status, ['podtver-d', 'prepayed'])) {

        // Если новый статус заказа "Заказ подтвержден День" или "Заказ подтвержден Ночь"
        // то сформируем транзакции по списанию товаров из заказа

        $items = json_decode($data['items'], true);

        // Добавим транзакции для списания товаров
        foreach ($items as $item) {
            if ($item == 'end') continue;

            $sku = $db->real_escape_string($item['offer']['id']);
            $quantity = -intval($item['quantity']);
            $date = date('Y-m-d H:i:s');
            $reason = $db->real_escape_string($data['number']);

            // Проверяем - если ли необходимость конвертировать этот артикул в другой
            $good = $db->query("select * from goods where id='2' and sku='$sku'")->fetch_assoc();
            if (!empty($good)) if (!empty($good['sku_convert'])) $sku = $db->real_escape_string($good['sku_convert']);

            // Добавляем транзакцию на списание
            $db->query("insert into goods_transactions (account_id, date, reason, sku, quantity) values ('2', '$date', '$reason', '$sku', '$quantity')");
            file_put_contents('metaship.order', "Transaction added: '2', '$date', '$reason', '$sku', '$quantity'", FILE_APPEND);

        }

    }


}
