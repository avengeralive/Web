<?php
require '../functions.php';
$mysqli = get_db();

const RESULT_REJECT = 0;
const RESULT_ACCEPT = 1;
const RESULT_OVERDRAWING = 2;

// Получаем HTTP POST BODY
$post = file_get_contents('php://input');

// http://php.net/manual/en/function.unpack.php
$request = unpack('a16card_number/Vlimit_id/dquantity', $post);

$stmt = $mysqli->prepare('SELECT l.quantity FROM ltypes lt LEFT JOIN limits l ON lt.id = l.limit_id WHERE lt.active = 1 AND lt.id = ? AND l.card_number = ?');
$stmt->bind_param('is', $request['limit_id'], $request['card_number']);

$result_status = RESULT_REJECT;
$result_data = '';

if ($stmt->execute()) {
     /* привязка переменных к запросу */
     file_put_contents('auth.log', 'Запрос ок', FILE_APPEND);
    $stmt->bind_result($quantity);
    if ($stmt->fetch()) {
        // Есть запись в limits
        $diff = (float)$quantity - (float)str_replace(',', '.', $request['quantity']);
     file_put_contents('auth.log', "Резульат ок q:$quantity, r: $request[quantity], diff: $diff", FILE_APPEND);
        if ($diff < 0) {
            // ЛИМИТ ПРЕВЫШЕН
            $result_status = RESULT_OVERDRAWING;
            $result_data = - $diff;
        } else {
            // ОДОБРЕНО
            $result_status = RESULT_ACCEPT;
        }
    } else {
        // Нет лимита для указанной карты, ОТКАЗ
        $result_status = RESULT_REJECT;
    }
} else {
     file_put_contents('auth.log', $mysqli->error . "\n", FILE_APPEND);
}

$stmt->close();

$stmt = $mysqli->prepare('INSERT INTO sales (date, time, card_number, quantity, limit_id, result) VALUES(NOW(), NOW(), ?, ?, ?, ?)');
if ($stmt) {
    $stmt->bind_param('idii', $request['card_number'], $request['quantity'], $request['limit_id'], $result_status);
    if (!$stmt->execute()) {
     file_put_contents('auth.log', $mysqli->error . "\n", FILE_APPEND);
    }
    $stmt->close();
} else {
     file_put_contents('auth.log', $mysqli->error . "\n", FILE_APPEND);
}
file_put_contents('input.json', json_encode($request));
file_put_contents('input.hex', $post);
echo pack('va16', $result_status, (string)$result_data);