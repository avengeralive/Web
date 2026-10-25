<?php

session_start();
if (!isset($_SESSION['code'])) {
    exit;
}

if (!isset($_GET['type']) || !in_array($_GET['type'], ['online', '15s', 'input', 'select', 'clicks','scroll','paste'])) {
    exit;
}
require dirname(__FILE__) . '/../utilities/bootstrap.php';
if ($_GET['type'] == 'online') {
    $sql = "update clients_log set metric_online=metric_online+5 where id=" . intval($_SESSION['code']);
    DB::getInstance()->query($sql);
} elseif ($_GET['type'] == 'paste') {
    $sql = "update clients_log set paste=1 where id=" . intval($_SESSION['code']);
    DB::getInstance()->query($sql);
} else {
    $sql = "update clients_log set metric_" . $_GET['type'] . "=1 where id=" . intval($_SESSION['code']);
    DB::getInstance()->query($sql);
}