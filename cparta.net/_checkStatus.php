<?php
include dirname(__FILE__) . '/includes/config.php';

$file = dirname(__FILE__) . '/_statuses';
$count = file_get_contents($file);

$zm = new Zakaz_Manager( DB::getInstance());
$zm->where('pinger_type', '', '!=');
$zm->where('status', 1);
$zm->limit(200);
$zm->offset($count);
$list = $zm->get();

if(count($list) > 0){
    $count = $count + 200;
}else{
    $count = 0;
}
file_put_contents($file, $count);

foreach($list as $zakaz){
    $zakaz->check();
}