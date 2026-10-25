<?php

require_once 'Engine.php';
require_once 'RP.php';
require_once 'AccordPost.php';


//echo date_diff(date_create('2021-04-21'), date_create('2021-04-29'), true)->d; exit;

//print_r(Engine::retailGetShops()['sites']); exit;

//$data = RP::calculateTariff('111024', 20, 200, 'PARCEL_CLASS_1', 'HN7_Pxhhp5dLOGjCatUkZi0dpSHllYJk', 'cmF0YXR1aS5jaG9AeWFuZGV4LmNvbTpIREdIRko1NDU='); echo RP::json_print($data);exit;
$data = RP::calculateTariff('111024', 20, 200, 'ONLINE_PARCEL', 'UPNlrf8sS56dPcMBzcmXF5BxKzddgISq', 'YW1hcml0bGFiaXJpbnRAYmsucnU6QW1hcml0a2Ftb2JsYWI='); echo RP::json_print($data);exit;
//$data = RP::courierFindAddresses('COURIER_CALL', 'BPHL0_nadxNJ2rMAhmDNbJ2DF5ouzbbX', 'bW9iaS5wcm9ncmVzc0Biay5ydTpLSkdIS0pHNDM2'); echo RP::json_print($data);exit;
//$data = RP::courierFindDates('467406', 'COURIER_CALL', 'BPHL0_nadxNJ2rMAhmDNbJ2DF5ouzbbX', 'bW9iaS5wcm9ncmVzc0Biay5ydTpLSkdIS0pHNDM2'); echo RP::json_print($data);exit;
//$data = RP::getBatch('9', 'BPHL0_nadxNJ2rMAhmDNbJ2DF5ouzbbX', 'bW9iaS5wcm9ncmVzc0Biay5ydTpLSkdIS0pHNDM2'); echo RP::json_print($data);exit;

//$data = RP::getSettings('HN7_Pxhhp5dLOGjCatUkZi0dpSHllYJk', 'c2VuY2h1cmluLmFAeWFuZGV4LnJ1OkhKSlZCS0I0NTQ1'); echo RP::json_print($data);exit;

//$batch = RP::getBatch('108', 'hqOQdujji07EiAQQXolb5ZaTqi5Zzmec', 'bnV0cmFtb2JpMjAyMEB5YW5kZXgucnU6cGlza2FrcmVtNzc3Nw=='); print_r($batch);exit;

//$batch = RP::getLastBatches(10, 'uyaPgi63ieTabHJ350DHKgGABD750YQi', 'YXRyZWRzNzc3QGdtYWlsLmNvbTpsb2xwcmlzZTc3Nw=='); print_r($batch);exit;

//$order = RP::getOrderByBarcode('80082655194514', 'hqOQdujji07EiAQQXolb5ZaTqi5Zzmec', 'bnV0cmFtb2JpMjAyMEB5YW5kZXgucnU6cGlza2FrcmVtNzc3Nw=='); print_r($order);exit;
//$order = RP::getOrderByBarcode('80080254916841'); print_r($order);exit;
//$order = RP::getOrder('330935544', 'hqOQdujji07EiAQQXolb5ZaTqi5Zzmec', 'bnV0cmFtb2JpMjAyMEB5YW5kZXgucnU6cGlza2FrcmVtNzc3Nw=='); print_r($order);exit;
//$order = RP::getOrder('314027670'); print_r($order);exit;

print_r(Engine::retailGetOrderById('760906')); exit;

//$sites = Engine::retailGetShops(); print_r($sites); exit;

//echo Engine::normalizePhone('+89161133105'); exit;

//$managers = Engine::retailGetUsers();
//uasort($managers, function($a, $b) { return $a['fullName'] > $b['fullName'] ? 1 : 0; });
//echo count($managers);
//print_r($managers); exit;

//$orders = Engine::retailGetOrders('2020-06-01', '2020-06-07', [], ['webshoppingnets-com-page-0b834687cd446c66801a458b7149175e5dcc67d1']);
//print_r($orders);

$orders = Engine::retailGetOrdersRaw('2020-06-01', '2020-06-07', [], ['aimanfun-xfastcart-com-r1'], ['complete']);
print_r($orders); exit;

$approved_states = [
    'availability-confirmed', // Заказ подтверждён ДЕНЬ ,
    'complete', // Выполнен,
    'availability-confirmed-night', // Заказ подтверждён НОЧЬ ,
    'transferred-bp', // Передан в БетаПро,
    'readytotransfer-bp', // Готов к передаче  бета про ,
    'temporary-storage', // временное хранение ,
    // Передан в бета про ,- double
    'temporary-storage-dop', // Доп.временное хранение ,
    'dop2-vrem-hran', // Доп2 временное хранение ,
    'transfererror-bp', // ошибка при передаче в бета про ,
    'delivering', // доставляется ,
    // доставка , ???
    'pvz', // В ПВЗ.
];
$canceled_states = [
    'no-product', // не оставлял заявку ,
    'already-buyed', // купил в другом месте ,
    'delyvery-did-not-suit', // не устроила доставка ,
    'podumaet', // отказ от звонка ,
    'prochee', // прочее,
    'ne-original', // не оригинал ,
    'otzivi', // отзывы ,
    'cancel-other', // отменен ,
    'opis', // опись ,
    'return', // возврат ,
    'kurier', // нужен курьер
];
$processing_states = [
    'wait', // ожидание ,
    'perezvoniy-pozge', // перезвонить позже ,
    'address-search', // поиск адреса
];
$total_states = array_merge($approved_states, $canceled_states, $processing_states);


//$states = Engine::retailGetOrdersByStates('2020-06-01', '2020-06-07', [], ['aimanfun-xfastcart-com-r1'], $approved_states); print_r($states);
//$states = Engine::retailGetOrdersByStates('2020-06-01', '2020-06-07', [], ['aimanfun-xfastcart-com-r1'], $canceled_states); print_r($states);
//$states = Engine::retailGetOrdersByStates('2020-06-01', '2020-06-07', [], ['aimanfun-xfastcart-com-r1'], $processing_states); print_r($states);
//$states = Engine::retailGetOrdersByStates('2020-06-01', '2020-06-07', [], ['aimanfun-xfastcart-com-r1'], $total_states); print_r($states);
//$states = Engine::retailGetOrdersByStates('2020-06-01', '2020-06-07', [], ['aimanfun-xfastcart-com-r1']); print_r($states);


/*
 *
Подтвержденные:
0    'availability-confirmed', // Заказ подтверждён ДЕНЬ ,
9    'complete', // Выполнен,
0    'availability-confirmed-night', // Заказ подтверждён НОЧЬ ,
12    'transferred-bp', // Передан в БетаПро,
0    'readytotransfer-bp', // Готов к передаче  бета про ,
0    'temporary-storage', // временное хранение ,
0    'temporary-storage-dop', // Доп.временное хранение ,
0    'dop2-vrem-hran', // Доп2 временное хранение ,
0    'transfererror-bp', // ошибка при передаче в бета про ,
69    'delivering', // доставляется ,
41    'pvz', // В ПВЗ.
131


Обработка
0            'wait', // ожидание ,
+12            'perezvoniy-pozge', // перезвонить позже ,
0            'address-search', // поиск адреса
12

Отмена
+26            'no-product', // не оставлял заявку ,
+9            'already-buyed', // купил в другом месте ,
4            'delyvery-did-not-suit', // не устроила доставка ,
9            'podumaet', // отказ от звонка ,
+73            'prochee', // прочее,
0            'ne-original', // не оригинал ,
4            'otzivi', // отзывы ,
0            'cancel-other', // отменен ,
2            'opis', // опись ,
2            'return', // возврат ,
6            'kurier', // нужен курьер
135

278

            +[no-product] => 26
            +[transferred-bp] => 12
            +[delivering] => 69
            +[perezvoniy-pozge] => 12
            +[prochee] => 73
            +[already-buyed] => 9
            [podumaet] => 9
            [otzivi] => 4
            [kurier] => 6
            [delyvery-did-not-suit] => 4
            [pvz] => 41
            [complete] => 9
            [return] => 2
            [opis] => 2

(
    [aimanfun.xfastcart.com/r1/ [191520] LOW / Домашний лазерный эпилятор AimanFun] => Array
        (
            [total] => 278
            [converted] => 131
            [result] => 47.12
        )

)


 *
 *
 */



//$statuses = Engine::retailGetStatuses();
//foreach ($statuses['statuses'] as $status) echo "$status[code] => $status[name]\n";

//$sites = Engine::retailGetShops();
//print_r($sites);
//foreach ($statuses['statuses'] as $status) echo "$status[code] => $status[name]\n";

//$sites = Engine::retailGetProducts();
//print_r($sites);

$report = Engine::reportApprove('2020-06-01', '2020-06-01', true, true, [27]);
print_r($report);

//$report = Engine::reportConversion('2020-06-01', '2020-06-07', false, [], ['aimanfun-xfastcart-com-r1']);
//print_r($report);

//$report = Engine::reportSpam('2020-05-24', '2020-05-24', true, [28]);
//print_r($report);

//$report = Engine::reportDelivery('2020-05-01', '2020-05-01', false, [28]);
//print_r($report);
//
//$report = Engine::reportAverageSummFinal('2020-05-01', '2020-05-01', false, [27]);
//print_r($report);
