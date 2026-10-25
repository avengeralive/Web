<?php
include dirname(__FILE__) . '/includes/config.php';

$file = dirname(__FILE__) . '/_statuses';
$count = file_get_contents($file);

$zm = new Zakaz_Manager( DB::getInstance());
$zm->where(false, 'id in ('.$_REQUEST['id'].')', Entity_Manager::WHERE_RAW);
//$zm->where('id', $_REQUEST['id'], '=');
$list = $zm->get();
//var_dump($list);

foreach($list as $zakaz){
    $zakaz->check();
}
if (count(explode(',', $_REQUEST['id'])) == 1) header('Location: https://cparta.net/zakaz.php?ob='.$_REQUEST['id']);
else header('Location: https://cparta.net/zakaz.php');