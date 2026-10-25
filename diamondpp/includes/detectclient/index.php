<?php

// Подключаем файл с функцией определения ГЕО посетителя
// Connect file with the definition of GEO visitor
include('./modules/detectclient/detector.php');
$country=$detector->get('country');
$short_country=$detector->get('country_code');
$region=$detector->get('region');
$town=$detector->get('city');
$ip=$detector->get('ip');
$browser_name=$detector->get('browser_name');
$browser_version=$detector->get('browser_ver');
$useragent=$detector->get('agent');
$platform=$detector->get('platform');
$referer=$detector->get('referer');
$mobile=$detector->get('mobile'); 

// Определяем переданные SubID если они есть
// Define SubID transferred if they have
$subid = array_values($_GET);
if (isset($subid[1])) {$subid1=htmlspecialchars($subid[1]);} else {$subid1='';}
if (isset($subid[2])) {$subid2=htmlspecialchars($subid[2]);} else {$subid2='';}
if (isset($subid[3])) {$subid3=htmlspecialchars($subid[3]);} else {$subid3='';}
if (isset($subid[4])) {$subid4=htmlspecialchars($subid[4]);} else {$subid4='';}
if (isset($subid[5])) {$subid5=htmlspecialchars($subid[5]);} else {$subid5='';}
?>