<?php

error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('error_log', 'php_errors.log');


$this_header = array(
'Host: catalog.mahle-aftermarket.com',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:60.0) Gecko/20100101 Firefox/60.0',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
'Accept-Encoding: gzip, deflate, br',
'Connection: keep-alive',
'Pragma: no-cache',
'Cache-Control: no-cache',
);

$f = fopen('log.txt', 'w');
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $this_header);
curl_setopt($ch, CURLOPT_URL, "https://catalog.mahle-aftermarket.com/eu/vehicle.xhtml?subId=0&eid=14#divider"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
curl_setopt ($ch, CURLOPT_SSLVERSION, 1); 
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_setopt($ch, CURLOPT_STDERR, $f);
$output = curl_exec($ch);

echo $output;