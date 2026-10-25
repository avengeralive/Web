<?php require_once 'include.config.php';

// Вызывается при смене статуса заказа в RetailCRM

$date = date('Y-m-d H:i:s');
$request = print_r($_REQUEST, true);

// Логируем
file_put_contents('retail.change.state.txt', "$date - $request'\n\n");

$data = $_REQUEST;

$status = $data['status'];

if (in_array($status, ['podtver-d', 'prepayed'])) {

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
