<?php

$div='&rarr;';
$tags["current"]["open"]='<li><strong>';
$tags["current"]["close"]='</strong></li>';
$tags["common"]["open"]='<li>';
$tags["common"]["close"]='</li>';
$aclass="";
$url="/admin";

$navigation=$site->navy($tags,$aclass,$div,$url);

$meta=$site->get_meta(":");

$tags["main"]["open"]='<ul class="pag">';
$tags["main"]["close"]='</ul>';
$tags["current"]["open"]='<li>';
$tags["current"]["close"]='</li>';
$tags["common"]["open"]='<li>';
$tags["common"]["close"]='</li>';
$aclass="";
$url="/admin";

$site->navy_bar($tags,$aclass,$bar_params,$url);
?>