<?php
include dirname(__FILE__) . '/includes/config.php';

$file = dirname(__FILE__) . '/_statuses';
$count = file_get_contents($file);

$zm = new Zakaz_Manager( DB::getInstance());
$zm->where('id', $_REQUEST['id'], '=');
$list = $zm->get();
//var_dump($list);

foreach($list as $zakaz){
    $zakaz->check();
}

header('Location: https://avaleads.pro/zakaz.php?ob='.$_REQUEST['id']);