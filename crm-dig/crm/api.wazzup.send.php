<?php require_once 'include.config.php';
/** @var mysqli $db */

const DEBUG = false;
/*
 * Точка входа для триггера RetailCRM отправки сообщения в Wazzup
 *
 */

//file_put_contents('retail.wazzup.log', file_get_contents('php://input').PHP_EOL, FILE_APPEND);

$settings = json_decode(file_get_contents('./settings.json'), true);

$send  = !empty($_REQUEST['send']) ? $_REQUEST['send'] : 0;
if ($send != 1) exit;

$order_id = $_REQUEST['order_id'];
$message = !empty($_REQUEST['message']) ? (string)$_REQUEST['message'] : '';
$phone  = !empty($_REQUEST['phone']) ? (string)$_REQUEST['phone'] : '';
$shop_code  = !empty($_REQUEST['shop_code']) ? (string)$_REQUEST['shop_code'] : '';
$name  = !empty($_REQUEST['name']) ? (string)$_REQUEST['name'] : '';
$patronymic  = !empty($_REQUEST['patronymic']) ? (string)$_REQUEST['patronymic'] : '';

file_put_contents('retail.wazzup.log', "send=$send\nshop_code=$shop_code\norder_id=$order_id\nname=$name\npatronymic=$patronymic\nphone=$phone\nmessage=$message\n\n", FILE_APPEND);

// Удаляем все нецифровые символы из телефона
$phone = preg_replace('/[^0-9]/', '', $phone);

if ($send && $message && $phone && $name) {
    // Присоединяем к имени отчество
    $name .= ($patronymic ? " $patronymic" : '');

    $message = str_replace('$1', $name, $message);

    sendMessage($phone, $message);

    $shop_code = $db->real_escape_string($shop_code);
    $row = $db->query("select * from shops_images where shop_code='$shop_code'")->fetch_assoc();
    if ($row) {

        $image_url = $row['image_url'];
        if ($image_url) sendMessage($phone, null, $image_url);

        $image2_url = $row['image2_url'];
        if ($image2_url) sendMessage($phone, null, $image2_url);

    }

}

function sendMessage($to, $message = null, $content = null, $author = null)
{
    global $db, $settings;
    $subdomain = $settings['wazzup_number'];
    $authorization = 'cee3088609284b66b6e5890fbf9c85d9';
    $from = $settings['wazzup_number'];

    $headers = [
        'Content-type: application/json',
        'Authorization: '.$authorization,
    ];

    $data = [
        'transport' => 'whatsapp',
        'from' => $from,
        'to' => $to,
    ];
    if ($message) $data['text'] = $message;
    if ($content) $data['content'] = $content;
    if ($author) $data['author'] = $author;

    if (!DEBUG) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://'.$subdomain.'.wazzup24.com/api/v1.1/send_message',
            CURLOPT_POST           => 1,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_SSL_VERIFYHOST => 0,
//            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $raw_response = curl_exec($curl);
        curl_close($curl);
    }
    else {
        $raw_response = '123';
    }

    $response = json_decode($raw_response, true);
    $guid = empty($response['guid']) ? null : (string)$response['guid'];

    if (true) {
        $now = date('Y-m-d H:i:s');
        $to = $db->real_escape_string($to);
        $message = $db->real_escape_string($message);
        $content = $db->real_escape_string($content);
        $author = $db->real_escape_string($author);
        $raw_response = $db->real_escape_string($raw_response);
        $db->query("insert into wazzup (datetime, `from`, `to`, `message`, content, author, guid, response) values ('$now', '$from', '$to', '$message', '$content', '$author', '$guid', '$raw_response')");
    }

    return $guid;

}

//WazzupApi::sendMessage('79161133105', null, 'https://avatars.mds.yandex.net/get-banana/41024/x25B9H2nl9pyu9fnhjm2kMCoJ_banana_20161021_mag-avto-ru-3.png/optimize');
