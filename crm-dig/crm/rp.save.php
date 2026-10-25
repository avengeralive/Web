<?php require_once './include.config.php';
/** @var mysqli $db */

/**
 *
 * Точка входа для интеграции Почты России с RetailCRM для сохранения заказа в апи отправки Почты России
 *
 */

const LOGGING = true;

$date = date('Y-m-d H:i:s');

$save = json_decode($_REQUEST['save'], true);

$log = "$date - ".RP::json_print($_REQUEST)."\n\nSave data: ".RP::json_print($save)."\n\n";

try {

    if (empty($save['delivery']['shipmentDate'])) throw new Exception('Для выгрузки в Почту России необходимо заполнить поле "Дата отгрузки"');

    // Аккаунт в RetailCRM, из которого выгружается заказ
    $account = $_REQUEST['clientId'];

    // TODO: вытащить это в настройки
    switch ($account) {
        case 'ava24'   : $domain ='ava-med24'; $key = 'CwtSZrWcftHjsFQ9Y6Jegp3AboOrZWpZ'; break;
        case 'digital' : $domain ='digital-shop'; $key = 'BrwZQ7VjvttAjzLPV3lmwa23LtqRSbAB'; break;
        default: throw new Exception("Неизвестный аккаунт '$account'");
    }

    // Получаем номер заказа
    $orderNumber = $save['order'];

    // Дата отгрузки
    $shipmentDate = $save['delivery']['shipmentDate'];

    // Загружаем данные о заказе из RetailCRM. Это нужно потому, что в интеграционную доставку по апи передаются не все данные.
    // Например, не передаются созданные вручную дополнительные поля.
    $order = json_decode(RP::sendGetRequest("https://$domain.retailcrm.ru/api/v5/orders/$orderNumber?apiKey=$key&by=id", []), true);
    $order = empty($order['order']) ? null : $order['order'];

    $log .= "Retail Get Order: ".RP::json_print($order)."\n\n";

    if (!$order) throw new Exception('Ошибка загрузки данных по заказу из RetailCRM');

    switch ($account) {
        case 'ava24'   : $cod_receiver = $order['customFields']['metaship_cod_receiver']; break;
        case 'digital' : $cod_receiver = $order['customFields']['blnp_id'] + 1; break;
        default: throw new Exception("Неизвестный аккаунт '$account'");
    }

    $mail_type = $order['delivery']['data']['tariff'];

    // Ищем подходящие активные настройки Почты для загрузки этого заказа
    $acc = $db->query("select * from rp_accounts where account='$account' and cod_receiver='$cod_receiver' and active=1 and parcel_types like '%,$mail_type,%'")->fetch_assoc();
    if (!$acc) throw new Exception('Нет подходящих настроек для загрузки этого заказа в Почту России!');

    // Авторизационные данные аккаунта Почты России для выгрузки заказа
    $espp = json_decode($acc['data'], true);

    $log .= "Auth data: $acc[id], $espp[auth], $espp[user]\n";

    // Подготавливаем массив данных для сохранения заказа в Почте России
    $body = [
        "postoffice-code" => $espp['ops'],
        "mail-direct" => 643,
        "mail-type" => $mail_type,
        "transport-type" => "SURFACE",
        "mass" => floatval($order['weight']),
        "order-num" => $order['number'],
        'no-return' => $order['customFields']['noreturn_betapro'],
    ];

    // ФИО и телефон получателя
    if (!empty($order['lastName'])) $body['surname'] = $order['lastName'];
    if (!empty($order['firstName'])) $body['given-name'] = $order['firstName'];
    if (!empty($order['patronymic'])) $body['middle-name'] = $order['patronymic'];
//    if (!empty($order['phone'])) $body['tel-address'] = $order['phone'];

    // Адрес доставки
    $address = $order['delivery']['address'];
    $body['address-type-to'] = 'DEFAULT';
    if (!empty($address['index'])) $body['index-to'] = $address['index'];
    if (!empty($address['region'])) $body['region-to'] = $address['region'];
    //if (!empty($address[''])) $body['area-to'] = $address[''];
    if (!empty($address['city'])) $body['place-to'] = $address['cityType'].' '.$address['city'];
    if (!empty($address['street'])) $body['street-to'] = $address['streetType'].' '.$address['street'];
    //if (!empty($address[''])) $body['vladenie-to'] = $order[''];
    if (!empty($address['building'])) $body['house-to'] = $address['building'];
    //if (!empty($address[''])) $body['letter-to'] = $address[''];
    //if (!empty($address[''])) $body['slash-to'] = $address[''];
    if (!empty($address['house'])) $body['building-to'] = $address['house'];
    if (!empty($address['housing'])) $body['corpus-to'] = $address['housing'];
    //if (!empty($address[''])) $body['office-to'] = $address[''];
    if (!empty($address['flat'])) $body['room-to'] = $address['flat'];

    // Проверяем необходимость указания наложенного платежа
    $cod = intval(floatval($order['totalSumm']) * 100);
    $body['insr-value'] = $cod;
    if ($cod > 0) {
        $body['payment'] = $cod;
        $body['mail-category'] = 'WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY';
    }
    else {
        $body['mail-category'] = 'WITH_DECLARED_VALUE';
    }

    $log .= "RP order: ".RP::json_print($body)."\n\n";

    // Если передано значение deliveryId, то значит это не создание нового заказа - а редактирование уже существующего
    $deliveryId = empty($save['deliveryId']) ? '' : $save['deliveryId'];
    if ($deliveryId) {

        throw new Exception("Изменение ранее загруженного заказа не поддерживается.");

//        $query = "select * from rp_orders where delivery_id='$deliveryId' limit 1";
//        $prev = $db->query($query)->fetch_assoc();
//        if (!$prev) throw new Exception("Указан несуществующий заказ $deliveryId");
//
//        $post = RP::updateOrder($deliveryId, $body, $espp['auth'], $espp['user']);
//
//        $log .= RP::json_print($post)."\n\n";
//
//        $post = RP::getOrder($deliveryId, $espp['auth'], $espp['user']);
//
//        $log .= RP::json_print($post)."\n\n";

    }
    else {

        // Создание нового заказа в Почте
        $post = RP::createOrder([$body], $espp['auth'], $espp['user']);

        if (isset($post['result-ids'])) {

            $deliveryId = $post['result-ids'][0];

            $log .= "RP created order: ".RP::json_print($post)."\n\n";

            $post = RP::getOrder($deliveryId, $espp['auth'], $espp['user']);
            $log .= "RP get order: ".RP::json_print($post)."\n\n";

            // HACK 2021.03.31 - если от Почты пришёл пустой ответ или ответ с ошибкой, то сделаем повторный запрос, потому что нам данные нужны для получения ШПИ и тарифа
            if (!$post || isset($post['error'])) {
                $post = RP::getOrder($deliveryId, $espp['auth'], $espp['user']);
                $log .= "RP get order double: ".RP::json_print($post)."\n\n";
            }

            $barcode = $post['barcode'];
            $mailtype = $post['mail-type'];

            $datetime_created = $db->real_escape_string(date('Y-m-d H:i:s'));

            $db->query('insert into rp_orders (order_id, delivery_id, barcode, state, parcel_type, cod_receiver, date_shipment, retail_account_id, rp_account_id, datetime_created) values '.
                "('$orderNumber', '$deliveryId', '$barcode', 1, '$mailtype', '$cod_receiver', '$shipmentDate', '$account', '$acc[id]', '$datetime_created')");

        }
        else {

            // Текст ошибки выгрузки по умолчанию
            $error = 'Ошибка создания заказа в АПИ отправки';

            // Пробуем вытащить из ответа Почты сообщение об ошибке, если таковое присутствует в ответе
            if (isset($post['errors'][0]['error-codes'][0]['description'])) $error = (string)$post['errors'][0]['error-codes'][0]['description'];

            throw new Exception($error);

        }

    }

    $delivery_cost = ($post['total-rate-wo-vat']+$post['total-vat']) / 100;

    $result = [
        'success' => true,
        'result' => [
            'deliveryId' => $deliveryId,
            'trackNumber' => $post['barcode'],
            'cost' => $delivery_cost,
            'status' => 1,
        ]
    ];

    // Обновим поле для трекинга liveinform
    $url ="https://$domain.retailcrm.ru/api/v5/orders/$orderNumber/edit?apiKey=$key";

    // Для digitalshop полученный номер трекинга записываем в поле track_strekoza (2020.11.11)
//    $barcode_field = ($account == 'digital') ? 'track_strekoza' : 'tracking';

    // Для всех аккаунтов выгружаем трек-номер в Стрекозу (2021.05.11)
    $barcode_field = 'track_strekoza';

    $update = [
        'customFields' => [
            $barcode_field => $post['barcode'],
            'rp_delivery_cost' => $delivery_cost, // Добавлена выгрузка стоимости доставки в отдельное поле, для отчетов (2021.02.04)
        ]
    ];

    $data = [
        'order' => json_encode($update),
        'by' => 'id',
        'site' => $order['site']
    ];

    $log .= "Update retail order: ".RP::json_print($data, true)."\n\n";

    RP::sendPostRequest($url, http_build_query($data));

    // Выгружаем данные по заказу в АккордПост, если получатель наложенного платежа СДТ-Пим
    if ($cod_receiver == 5) {

        // Подготавливаем данные для отправки запроса в АккордПост
        $barcode = $post['barcode'];
        $cod = floatval($post['payment'] / 100.0);
        $ins = floatval($post['insr-value'] / 100.0);
        $weight = floatval($post['mass'] / 1000.0);
        $blnp_id = AccordPost::PROD_BLNP_ID;
        $mass_rate = floatval($post['mass-rate-with-vat'] / 100.0);
        $insr_rate = floatval($post['insr-rate-with-vat'] / 100.0);
        $air_rate = 0;

        // ФИО и телефон получателя
        $recipient = $post['recipient-name'];

        // Элементы адреса
        $address = $order['delivery']['address'];
        $zip = $post['index-to'];
        $region = !empty($address['region']) ? $address['region'] : '';
        $city = !empty($address['city']) ? $address['cityType'].' '.$address['city'] : '';
        $street = !empty($address['street']) ? $address['streetType'].' '.$address['street'] : '';
        $house = implode(', ', array_filter([
            !empty($address['building']) ? $address['building'] : '',
            !empty($address['house']) ? $address['house'] : '',
            !empty($address['housing']) ? $address['housing'] : '',
            !empty($address['flat']) ? $address['flat'] : '',
        ]));

        $token = AccordPost::getToken(AccordPost::PROD_PARTNER_ID, AccordPost::PROD_PASSWORD);
//        $token = AccordPost::getToken(AccordPost::TEST_PARTNER_ID, AccordPost::TEST_PASSWORD);
        $request = new SimpleXMLElement('<create-external-purchase-orders/>');
        $request->addAttribute('token', $token);
        $doc = $request->addChild('doc');
        $doc->addAttribute('zdoc_id', 'zdoc_'.$orderNumber.'_'.$barcode);
        $doc->addAttribute('system_id', 'DIGITAL CRM');
        $order_set = $doc->addChild('order-set');
        $ord = $order_set->addChild('order');
        $ord->addAttribute('order_id', $orderNumber);
        $ord->addAttribute('delivery_type', 1); // Почта России
        $ord->addAttribute('zip', $zip);
        $ord->addAttribute('clnt_name', $recipient);
        $ord->addAttribute('parcel_nalog', $cod);
        $ord->addAttribute('parcel_sumvl', $ins);
        $ord->addAttribute('blnp_ip', $blnp_id);

        $struct_addr = $ord->addChild('struct_addr');
        $struct_addr->addAttribute('region', $region);
        $struct_addr->addAttribute('city', $city);
        $struct_addr->addAttribute('street', $street);
        $struct_addr->addAttribute('house', $house);

        $parcel_set = $ord->addChild('parcel-set');

        $parcel = $parcel_set->addChild('parcel');
        $parcel->addAttribute('barcode', $barcode);
        $parcel->addAttribute('parcel_type', AccordPost::$rpTariffsCodes[$post['mail-type']]);
        $parcel->addAttribute('weight', $weight);
        $parcel->addAttribute('stp_date', date('d.m.Y', strtotime($shipmentDate)));
        $parcel->addAttribute('impose_sum', $cod);
        $parcel->addAttribute('assessed_cost', $ins);
        $parcel->addAttribute('mass_rate', $mass_rate);
        $parcel->addAttribute('insurance_rate', $insr_rate);
        $parcel->addAttribute('air_rate', $air_rate);
        $parcel->addAttribute('total_fee', $mass_rate+$insr_rate+$air_rate);

        try {
            $response = AccordPost::sendApiRequest($request);
            $response = is_a($response, 'SimpleXMLElement') ? AccordPost::xmlToString($response) : 'AccordPost send error: '.strval($response);
        }
        catch (Exception $e) {
            $response = 'AccordPost send error: '.$e->getMessage();
        }

        $accord_log = "AccordPost: \n".AccordPost::xmlToString($request)."\n----\n".$response."\n*\n";

        $log .= $accord_log;

        $accord_log = $db->real_escape_string($accord_log);

        $db->query("update rp_orders set log='$accord_log' where delivery_id='$deliveryId'");

    }

}
catch (Exception $e) {

    $result = [
        'success' => false,
        'errorMsg' => $e->getMessage(),
    ];

}
$log .= "Return: ".RP::json_print($result)."\n\n";

if (LOGGING) file_put_contents('rp.save.log', $log, FILE_APPEND);

echo json_encode($result);
