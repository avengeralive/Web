<?php
// Пишем в базу данные о визите посетителя
// Write to the data on the visit of the visitor database
if (!isset($userid)) {
    $userid = '0';
} else {
    $userid = $mysqli->real_escape_string($userid);
}
if (!isset($offerid)) {
    $offerid = '0';
} else {
    $offerid = $mysqli->real_escape_string($offerid);
}
if (!isset($ownerid)) {
    $ownerid = '0';
} else {
    $ownerid = $mysqli->real_escape_string($ownerid);
}
if (!isset($prelandingid)) {
    $prelandingid = '0';
} else {
    $prelandingid = $mysqli->real_escape_string($prelandingid);
}
if (!isset($landingid)) {
    $landingid = '0';
} else {
    $landingid = $mysqli->real_escape_string($landingid);
}
if (!isset($code)) {
    $code = '';
} else {
    $code = $mysqli->real_escape_string($code);
}
if (!isset($stream_id)) {
    $stream_id = '';
} else {
    $stream_id = $mysqli->real_escape_string($stream_id);
}

$country = $mysqli->real_escape_string($country);
$short_country = $mysqli->real_escape_string($short_country);
$region = $mysqli->real_escape_string($region);
$town = $mysqli->real_escape_string($town);
$ip = $mysqli->real_escape_string($ip);
$browser_name = $mysqli->real_escape_string($browser_name);
$browser_version = $mysqli->real_escape_string($browser_version);
$referer = $mysqli->real_escape_string($referer);
$useragent = $mysqli->real_escape_string($useragent);
$platform = $mysqli->real_escape_string($platform);
$mobile = $mysqli->real_escape_string($mobile);
if (isset($subid1)) {
    $subid1 = $mysqli->real_escape_string($subid1);
} else {
    $subid1 = '';
}
if (isset($subid2)) {
    $subid2 = $mysqli->real_escape_string($subid2);
} else {
    $subid2 = '';
}
if (isset($subid3)) {
    $subid3 = $mysqli->real_escape_string($subid3);
} else {
    $subid3 = '';
}
if (isset($subid4)) {
    $subid4 = $mysqli->real_escape_string($subid4);
} else {
    $subid4 = '';
}
if (isset($subid5)) {
    $subid5 = $mysqli->real_escape_string($subid5);
} else {
    $subid5 = '';
}
if($userid == 13){
$logger = Registry::get('di')->logger;
$logger->info('111#' . $_SESSION['prelend'] . ' - ' . $stream_id . ' - ' . $usePreland);
}
$cl = new Client_Log;
session_start();

if($usePreland === false){
    $cl->user_id = $userid;
    $cl->stream = $stream_id;
    $cl->offer_id = $offerid;
    $cl->owner_id = $ownerid;
    $cl->landing_id = $landingid;
    $cl->code = $code;
    $cl->country = $country;
    $cl->short_country = $short_country;
    $cl->region = $region;
    $cl->town = $town;
    $cl->ip = $ip;
    $cl->browser_name = $browser_name;
    $cl->browser_version = $browser_version;
    $cl->referer = $referer;
    $cl->referer_host = parse_url($referer, PHP_URL_HOST);
    $cl->useragent = $useragent;
    $cl->platform = $platform;
    $cl->mobile = $mobile;
    $cl->subid1 = $subid1;
    $cl->subid2 = $subid2;
    $cl->subid3 = $subid3;
    $cl->subid4 = $subid4;
    $cl->subid5 = $subid5;
    $cl->create();
 

    $result = true;
    $last_insert_client = $cl->id;
    
    $_SESSION['code'] = $last_insert_client;
    
    if ($landingid > 0) {
        $sql = "update landings set hits=hits+1 where id=" . intval($landingid);
        $mysqli->query($sql);
    }
    
}elseif((isset($usePreland) && $usePreland !== false) && !isset($_SESSION['prelend'])){
    $cl->user_id = $userid;
    $cl->stream = $stream_id;
    $cl->offer_id = $offerid;
    $cl->owner_id = $ownerid;
    $cl->prelanding_id = $prelandingid;
    $cl->code = $code;
    $cl->country = $country;
    $cl->short_country = $short_country;
    $cl->region = $region;
    $cl->town = $town;
    $cl->ip = $ip;
    $cl->browser_name = $browser_name;
    $cl->browser_version = $browser_version;
    $cl->referer = $referer;
    $cl->referer_host = parse_url($referer, PHP_URL_HOST);
    $cl->useragent = $useragent;
    $cl->platform = $platform;
    $cl->mobile = $mobile;
    $cl->subid1 = $subid1;
    $cl->subid2 = $subid2;
    $cl->subid3 = $subid3;
    $cl->subid4 = $subid4;
    $cl->subid5 = $subid5;
    $cl->create();
    
    $result = true;
    $last_insert_client = $cl->id;
    
    $_SESSION['prelend'] = $last_insert_client;
    $_SESSION['code'] = $last_insert_client;
    if($userid == 13){
        $logger = Registry::get('di')->logger;
        $logger->info('lastinsert#' . $_SESSION['prelend'] . ' - ' . $last_insert_client );  
    }  
    if ($prelandingid > 0) {
        $sql = "update prelandings set hits=hits+1 where id=" . intval($prelandingid);
        $mysqli->query($sql);
    } 
    
}elseif((isset($usePreland) && $usePreland !== false) && isset($_SESSION['prelend'])){
    if($userid == 13){
        $logger = Registry::get('di')->logger;
        $logger->info('SES#' . $_SESSION['prelend'] . ' - ' . $stream_id . ' - ' . $usePreland);  
    }

    $sql = "update clients_log set landing_id='$landingid',prelendToLend = 1 where id=" . intval($_SESSION['prelend']);
    $mysqli->query($sql);
    unset($_SESSION['prelend']);
    
    if ($landingid > 0) {
        $sql = "update landings set hits=hits+1 where id=" . intval($landingid);
        $mysqli->query($sql);
    }
}



?>