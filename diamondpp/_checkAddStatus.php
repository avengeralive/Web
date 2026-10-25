<?php

include dirname(__FILE__) . '/includes/config.php';

$zm = new Zakaz_Manager( DB::getInstance());
$zm->where('status', [2,3], Entity_Manager::WHERE_IN );
$zm->where('addstatus', [0,1,2,3,6,7,8,9], Entity_Manager::WHERE_IN );
$zm->where('pinger_type', '', '!=');
$zm->where('pinger_value', '', '!=');
$zm->limit(-1);
$list = $zm->get();
$cnt = 0;
foreach($list as $zakaz){
    $zakaz->checkAddStatus();
    echo $zakaz->id;
    echo '<br>';
    $cnt++;
}
echo 'Обновлено '.$cnt.' заказов';
