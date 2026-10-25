<?php
$ch = curl_init(); 
//curl_setopt($ch, CURLOPT_URL, 'https://cr.intelcom.su/api?op=auth&login=550210011&password=009964746808'); 
curl_setopt($ch, CURLOPT_URL, 'https://cr.intelcom.su/api?op=auth&login=550210013&password=638452935025'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_REFERER, FALSE);
curl_setopt($ch, CURLOPT_HEADER, 1);
$head = curl_exec($ch); 
var_dump($head);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
var_dump($httpcode);
$matches = array();
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $head, $matches);
$cookies = array();
echo "<br>";
var_dump($matches);
echo "<br>";
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
var_dump($cookies);


curl_close($ch);

$cfile = curl_file_create('./robot/call_50/tmp.mp3','audio/mpeg','testaudio'); // try adding 

// Create a CURLFile object / oop method 
#$cfile = new CURLFile('resource/test.png','image/png','testpic'); // uncomment and use if the upper procedural method is not working.

// Assign POST data

$postData = array(
    'MAX_FILE_SIZE' => '33554432',
    'rawres' => 1,
    'synthz_add_file' => $cfile,
    'synthz_add_file_description' => ''
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://cr.intelcom.su/fs_putfile');
curl_setopt($curl, CURLOPT_USERAGENT,'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
curl_setopt($curl, CURLOPT_HTTPHEADER,array('User-Agent: Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15','Referer: http://someaddress.tld','Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_POST, true); // enable posting
curl_setopt($curl, CURLOPT_POSTFIELDS, $postData); // post images 
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // if any redirection after upload
curl_setopt($curl, CURLOPT_REFERER, FALSE);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Cookie: ctsession=".$cookies['ctsession']."; crsidr=1; crsid=".$cookies['crsid']));
$r = curl_exec($curl); 
curl_close($curl);

var_dump($r);

$z = json_decode($r, true);
$z['fileid'];

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://cr.intelcom.su/process?op=vn_extra_tm_create_simple_task&sid=".$cookies['crsid']."&action_id=87&dial_to=79850956582&num_a=74953741734&phrase_id=".$z['fileid']."&redirect_to=000000"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_REFERER, FALSE);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Cookie: ctsession=".$cookies['ctsession']."; crsidr=1; crsid=".$cookies['crsid']));
$head = curl_exec($ch); 
var_dump($head);

curl_close($ch);


?>