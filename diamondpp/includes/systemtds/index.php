<?php

// Проверка, нужна ли переадресация (системная ТДС)
// Check if the forwarding needed (system TDS)
if (!isset($page))
    $page = 1;
$page = htmlentities($page);
$referer = htmlentities($referer);
$ip = htmlentities($ip);
$platform = htmlentities($platform);
$useragent = htmlentities($useragent);
$country = htmlentities($country);

$sovpadenie = 0;

$sql_systemtds = "SELECT * FROM system_tds";
$result_systemtds = $mysqli->query($sql_systemtds);
if (mysqli_num_rows($result_systemtds) > 0) {
    while ($res_systemtds = mysqli_fetch_array($result_systemtds)) {
        if ((isset($res_systemtds['page']) && $res_systemtds['page'] == $page) || (isset($res_systemtds['page']) && $res_systemtds['page'] == '')) {
            $sovpadenie = $sovpadenie + 1;
        }
        if ((isset($res_systemtds['referer']) && $res_systemtds['referer'] == $referer) || (isset($res_systemtds['referer']) && $res_systemtds['referer'] == '')) {
            $sovpadenie = $sovpadenie + 1;
        }
        if ((isset($res_systemtds['ip']) && $res_systemtds['ip'] == $ip) || (isset($res_systemtds['ip']) && $res_systemtds['ip'] == '')) {
            $sovpadenie = $sovpadenie + 1;
        }
        if ((isset($res_systemtds['platform']) && $res_systemtds['platform'] == $platform) || (isset($res_systemtds['platform']) && $res_systemtds['platform'] == 'All')) {
            $sovpadenie = $sovpadenie + 1;
        }
        if ((isset($res_systemtds['useragent']) && $res_systemtds['useragent'] == $useragent) || (isset($res_systemtds['useragent']) && $res_systemtds['useragent'] == '')) {
            $sovpadenie = $sovpadenie + 1;
        }
        if (isset($res_systemtds['country']) && $res_systemtds['country'] == $country) {
            $sovpadenie = $sovpadenie + 1;
        }
        if (isset($res_systemtds['destination']) && $res_systemtds['destination'] != '') {
            $sovpadenie = $sovpadenie + 1;
        }
        if ($sovpadenie == mysqli_num_fields($result_systemtds) - 2) {
            $destination_systemtds = htmlentities($res_systemtds['destination']);
            Header("Location: $destination_systemtds");
            exit;
        }
        $sovpadenie = 0;
    }
}

