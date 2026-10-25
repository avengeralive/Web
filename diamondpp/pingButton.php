<?php

include dirname(__FILE__) . '/includes/config.php';

$file = dirname(__FILE__) . '/_statuses';
$count = file_get_contents($file);

$zm = new Zakaz_Manager( DB::getInstance());
$zm->where('id', $_REQUEST['id'], '=');
$list = $zm->get();

foreach($list as $zakaz){
    $sql = "SELECT * FROM offers_owner WHERE `offer_id` = '$zakaz->offer_id'";
    $res = (mysqli_num_rows($mysqli->query($sql))>0) ? $mysqli->query($sql)->fetch_assoc() : null;

    $zakaz->pingAgain($res);
}


header('Location: https://avaleads.pro/zakaz.php?ob='.$_REQUEST['id']);