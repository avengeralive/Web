<?php require_once 'include.config.php';
/** @var mysqli $db */

/**
 *
 * [13:55, 17.09.2019] Максим Ядыкин: sumka55-2019.site/resiver11-2019.site/ вот эти можно сайты взять для теста по распределению заказов
 * [12:48, 18.09.2019] Archie O'Hare: http://digital-shop.su/crm/
 * [12:48, 18.09.2019] Archie O'Hare: user
 * pass
 * [18:08, 18.09.2019] Максим Ядыкин: можем ли мы с указанных двух магазинов отправлять тестовые заказы, которые в ретейле вы отмените?
 * [18:08, 18.09.2019] Максим Ядыкин: Да, конечно, пишите тест в имени только
 *
 * 2019.10.04 - Archie O'Hare
 * Доработан случай предустановленного менеджера в загружаемом заказе.
 * В этом случае менеджер по графику не зназначается, заказ пропускается в RetailCRM в неизменном виде
 *
 * 2019.10.31 - Archie O'Hare
 * Добавлена обработка параметра SID для трекинга Кейтаро
 *
 * 2020.10.14 - Archie O'Hare
 * Добавлена установка дополнительного поля moneylead, если в базе есть стоимость лида для данного магазина
 *
 *
 **/


/**
 * Возвращает http-ошибку и прекращает выполнение
 *
 * @param int $code HTTP-код ошибки
 * @param string $message Сообщение об ошибке
 * @param string $html Тело ответа
 */
function httpError($code, $message, $html = '') {
    //file_put_contents('./http.error.txt', date('Y-m-d H:i:s')." HTTP $code $message\n$html\n\n\n", FILE_APPEND);
    header("HTTP/1.1 $code $message");
    if ($html != '') echo $html;
    exit;
}

const AUTH_TOKEN = '12345';
const HTTP_LOGGING = false;
const LOGGING = false;

if ($_SERVER['REQUEST_METHOD'] != 'POST') httpError(405, '405 Method Not Allowed');

$req = $db->real_escape_string(json_encode($_REQUEST, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
$now = date('Y-m-d H:i:s');
if (HTTP_LOGGING) {
//    $log_id = $db->query("insert into http_log (datetime, request) values ('$now', '$req')");
    $log_id = $db->insert_id;
}
if (LOGGING) {
    file_put_contents('./data.raw.log', $now.'------------------'.PHP_EOL.print_r($_REQUEST, true).PHP_EOL.'------------------'.PHP_EOL, FILE_APPEND);
}

$token = isset($_REQUEST['token']) ? $_REQUEST['token'] :'';

// Проверка аутентификационного токена
if ($token != AUTH_TOKEN) httpError(403, 'Forbidden');

// Получаем из запроса исходные данные для запроса в CRM
$url = isset($_REQUEST['url']) ? $_REQUEST['url'] : '';
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'GET';
$data = isset($_REQUEST['data']) ? json_decode($_REQUEST['data'], true) : null;
$subid = isset($_REQUEST['subid']) ? $_REQUEST['subid'] : null;

// Функция проверяет, работает ли менеджер в указанный час
// $curHour - текущий час для проверки
// $hoursDay - количество дневных рабочих часов
// $hoursNight - количество ночных часов
function isManagerWorking($curHour, $hoursDay, $hoursNight) {
    $hours = array_fill(0, 24, false);

    // Заполняем дневные рабочие часы
    for ($k=1; $k<=$hoursDay; $k++) $hours[8+($k-1)] = true;

    // С ночными часами сложнее:
    // Если количество часов от 1 до 2 включительно - то это часы работы с 00:00
    // Если количество часов равно 3 - то это часы работы с 21:00
    // Если от 4 до 8 включительно - то это часы работы с 00:00
    // Если от 8 до 11 - то это с 00:00 до 07:59 плюс после 21:00
    if ($hoursNight <= 2) for($k=1;$k<=$hoursNight;$k++) $hours[00+($k-1)] = true;
    elseif ($hoursNight == 3) for($k=1;$k<=$hoursNight;$k++) $hours[21+($k-1)] = true;
    else {
        $morningHours = ($hoursNight <= 8) ? $hoursNight : 8;
        $eveningHours = ($hoursNight > 8) ? ($hoursNight-8) : 0;
        for($k=1;$k<=$morningHours;$k++) $hours[00+($k-1)] = true;
        for($k=1;$k<=$eveningHours;$k++) $hours[21+($k-1)] = true;
    }

    return $hours[$curHour];
}

// Если это запрос на создание заказа и в нём присутствуют данные о заказе
if (strpos($url, '/orders/create') && ($order = json_decode($data['order'], true))) {

    // Флаг изменения данных о заказе
    $order_modified = false;

    $curDate = date('Y-m-d H:i:s');

    if (LOGGING) file_put_contents('./data.json', $now.'------------------'.PHP_EOL.print_r($data, true).PHP_EOL.'------------------'.PHP_EOL, FILE_APPEND);

    // Данные по заказу
    $site = !empty($data['site']) ? $data['site'] : null;
    $phone = !empty($order['phone']) ? $order['phone'] : '';
    $phoneNormalized = Engine::normalizePhone($phone);
    $phoneNormalizedEscaped = $db->real_escape_string($phoneNormalized);
    $recipient = !empty($order["firstName"]) ? $order["firstName"] : '';
    $recipientEscaped = $db->real_escape_string($recipient);

    // Нормализованный телефон записываем обратно в заказ (ADDED 2020.06.20)
    $order['phone'] = $phoneNormalized;

    // Если в заказе не предустановлен менеджер - назначаем менеджера
    if (!isset($order['managerId'])) {

        $curHour = date('G');
        $curDay = date('j');

        // Определяем текущую смену
        if (8 <= $curHour && $curHour < 21) {
            $curShift = 'day';
            $curShiftBegin = date('Y-m-d H:i:s', mktime(8, 0, 0, date('m'), date('d'), date('Y')));
            $curShiftEnd = date('Y-m-d H:i:s', mktime(21, 0, 0, date('m'), date('d'), date('Y')));
        } else {
            $curShift = 'night';

            if (0 <= $curHour && $curHour <= 8) {
                $yesterday = strtotime('-1 day');
                $curShiftBegin = date('Y-m-d H:i:s', mktime(21, 0, 1, date('m', $yesterday), date('d', $yesterday), date('Y', $yesterday)));
                $curShiftEnd = date('Y-m-d H:i:s', mktime(7, 59, 59, date('m'), date('d'), date('Y')));
            } else {
                $tomorrow = strtotime('+1 day');
                $curShiftBegin = date('Y-m-d H:i:s', mktime(21, 0, 1, date('m'), date('d'), date('Y')));
                $curShiftEnd = date('Y-m-d H:i:s', mktime(7, 59, 59, date('m', $tomorrow), date('d', $tomorrow), date('Y', $tomorrow)));
            }
        }

        // По умолчанию никого не назначаем
        $assignedManager = 0;

        // Прочитаем расписание всех менеджеров на сегодня
        $schedule = [];
        $res = $db->query("select * from schedule order by manager_id");
        while ($row = $res->fetch_assoc()) {
            $hours = explode(',', $row['hours']);
            $hours_day = intval(!empty($hours[($curDay-1)*2]) ? $hours[($curDay-1)*2] : 0);
            $hours_night = intval(!empty($hours[($curDay-1)*2+1]) ? $hours[($curDay-1)*2+1] : 0);
            if ($hours_day || $hours_night) $schedule[$row['manager_id']] = [
                'day' => $hours_day,
                'night' => $hours_night
            ];
        }

        // Попробуем найти в текущей смене заказ с тем же номером телефонома получателя
        $prevOrder = null;
        $query = "select * from orders where datetime between '$curShiftBegin' and '$curShiftEnd' and phone='$phoneNormalizedEscaped' order by datetime desc limit 1";
        $prevOrder = $db->query($query)->fetch_assoc();

        // Если нашли - проверить, работает ли сейчас менеджер того заказа
        if ($prevOrder) {
            $prevManagerId = $prevOrder['manager_id'];

            // Проверить - работает ли сейчас менеджер, назначенный тому заказу
            if (isset($schedule[$prevManagerId])) {
                if (isManagerWorking($curHour, $schedule[$prevManagerId]['day'], $schedule[$prevManagerId]['night'])) {

                    // Назначить новому заказу менеджера предыдущего заказа
                    $assignedManager = $prevManagerId;
                }
            }
        }

        // Если на прошлом шаге менеджера присвоить не получилось
        if (!$assignedManager) {

            // Собрать список менеджеров, которые работают в данный час
            $managers = [];
            foreach ($schedule as $managerId => $hours) {
                if (isManagerWorking($curHour, $hours['day'], $hours['night'])) $managers[] = $managerId;
            }

            // Из них выбрать нужного, записать в заказ -  и запомнить
            if ($managers) {

                // Отсортируем список менеджеров
                sort($managers);

                // Берем крайнего назначенного менеджера
                $params = $db->query('select * from settings')->fetch_assoc();
                $latestMgr = $params['latest_mgr'];

                // Ищем его в таблице активных
                $pos = array_search($latestMgr, $managers);
                if ($pos === false) {
                    // Если его нет в таблице - берем первого менеджера
                    $assignedManager = $managers[0];
                }
                else {
                    // Нашли в списке - берем следующего по списку, или первого в списке, если он последний
                    $assignedManager = !empty($managers[$pos+1]) ? $managers[$pos+1] : $managers[0];

                }

                // Сохраняем нового крайнего назначенного менеджера
                $db->query("update settings set latest_mgr=$assignedManager where true");

            }

        }

        // Запишем присвоенного менеджера в создаваемый заказ
        if ($assignedManager) {
            $order['managerId'] = $assignedManager;
            $order['customFields']['current_order_manager'] = $assignedManager;
        }
        // TODO: Возможно, стоит обработать ошибку при невозможности присвойки менеджера

        // Флаг изменения данных о заказе
        $order_modified = true;

    }
    // Менеджер был уже предустановлен при создании заказа - получаем его код для сохранения в базе
    else $assignedManager = $order['managerId'];

    // 2020.11.11 Если в загружаемом заказе напрямую указана стоимость доставки 'delivery' -> 'cost', удаляем её,
    // стоимость будет определяться по правилами, прописанным в RetailCRM
    if (isset($order['delivery']['cost'])) {
        unset($order['delivery']['cost']);
        // Флаг изменения данных о заказе
        $order_modified = true;
    }

    // Обрабатываем из базы стоимость лидов в зависимости от магазина
    $site_escaped = $db->real_escape_string($site);
    $lead = $db->query("select * from leads_prices where site_id='$site_escaped'")->fetch_assoc();
    if ($lead) {
        // Если по данному магазину указана цена лица - записываем её в кастомное поле
        $order['customFields']['moneylead'] = $lead['price'];
        // Флаг изменения данных о заказе
        $order_modified = true;
    }

    // Если в процессе обработки заказ был изменён, то записываем новые данные обратно в заказ
    if ($order_modified) $data['order'] = json_encode($order);

    // Записываем заказ локально в базу
    $order_data = $db->real_escape_string(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    $row = $db->query("insert into orders (datetime, recipient, phone, manager_id, data, site) values ('$curDate', '$recipientEscaped', '$phoneNormalizedEscaped', $assignedManager, '$order_data', '$site')");
    $local_order_id = $db->insert_id;

}
else $local_order_id = 0;

// Отправляем запрос дальше в CRM
$curl = curl_init();
$headers = [];
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, "PHP API Client");
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
if ($data) {
    if ($method == "POST") {
        $headers [] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    } else {
        $url = $url . (strpos($url, '?') ? '&' : '?') . http_build_query($data);
        if (LOGGING) file_put_contents('./data', $url.PHP_EOL.PHP_EOL, FILE_APPEND);
        curl_setopt($curl, CURLOPT_URL, $url);
    }
}
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($curl);
$responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if (LOGGING) file_put_contents('./result.raw.log', date('Y-m-d H:i:s').PHP_EOL.'Result: '.PHP_EOL.$result.PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND);

if (HTTP_LOGGING) {
    $rawResultEscaped = $db->real_escape_string($result);
//    $db->query("update http_log set response_raw='$rawResultEscaped' where id=$log_id");
}

// Если ответ пустой - то просто вернём ошибку http
if ($result === false) httpError($responseStatus, 'ERROR');

// Ответ непустой, но была ошибка - запишем ошибку и вернём и ошибку, и ответ
if ($responseStatus > 299) {

    $response = json_decode($result, true);

    $message = empty($response['errorMsg']) ? 'ERROR' : $response['errorMsg'];
    $errors = isset($response['errors']) ? (PHP_EOL.json_encode($response['errors'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) : '';
    $message = $db->real_escape_string($message.$errors);

    $db->query("update orders set retail_message='$message' where id=$local_order_id");

    httpError($responseStatus, 'ERROR', $result);
}

// Если был запрос на создание заказа, и он выполнился успешно - нужно записать в базу полученный от CRM id заказа
if (strpos($url, '/orders/create')) {
    $response = json_decode($result, true);
    if (isset($response['id'])) {

        // ID созданного заказа, полученный в ответ из CRM
        $orderId = $response['id'];

        // Сохраняем номер в базу
        $db->query("update orders set retail_id=$orderId where id=$local_order_id");

        // Если установлен параметр трекинга Кейтаро - тоже запишем его в базу
        if ($subid) $db->query("update orders set sid='$subid' where id=$local_order_id");

    }
    elseif (isset($response['errorMsg'])) {

        // Ошибка загрузки заказа, запишем её

        $message = $response['errorMsg'];
        $errors = isset($response['errors']) ? (PHP_EOL.json_encode($response['errors'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) : '';
        $message = $db->real_escape_string($message.$errors);

        $message = $db->real_escape_string($result);

        $db->query("update orders set retail_message='$message' where id=$local_order_id");

    }

    if (LOGGING) file_put_contents('./data.json', print_r($response, true).PHP_EOL.'------------------'.PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND);

}

if (HTTP_LOGGING) {
    $resultEscaped = $db->real_escape_string(json_encode(json_decode($result, true), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
//    $db->query("update http_log set response='$resultEscaped' where id=$log_id");
}

// В случае успеха просто вернём ответ
echo $result;
