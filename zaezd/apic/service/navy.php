<?php

$div='&rarr;';
$tags["current"]["open"]='<li><strong>';
$tags["current"]["close"]='</strong></li>';
$tags["common"]["open"]='<li>';
$tags["common"]["close"]='</li>';
$aclass="";
$url="";

$navigation=$site->navy($tags,$aclass,$div,$url);

$meta=$site->get_meta(":");

if($global_mode=="buy") $meta["title"]="Подбор оборудования, поставщиков, подрядчиков";

$tags["main"]["open"]='<ul class="pagination">';
$tags["main"]["close"]='</ul>';
$tags["current"]["open"]='<li class="current">';
$tags["current"]["close"]='</li>';
$tags["common"]["open"]='<li>';
$tags["common"]["close"]='</li>';
$aclass="";
$url="";

$site->navy_bar($tags,$aclass,$bar_params,$url);
?>