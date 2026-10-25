<?php
include dirname(__FILE__) . '/includes/config.php';
$zm = new Zakaz_Manager( DB::getInstance());
$zm->where('status', 2);
$zm->where('pinger_type', '', '!=');
$zm->where('pinger_value', '', '!=');
$zm->limit(-1);
$list = $zm->get();
foreach($list as $zakaz){
    $zakaz->check();
    echo $zakaz->id;
    echo '<br>';
}