<?php
require_once('PhpSIP.class.php');

/* Sends NOTIFY to reset Linksys phone */

try
{
  $api = new PhpSIP('217.174.178.108');
  $api->setUsername('0780100001003'); // authentication username
  $api->setPassword('JMb6ffxl9Z'); // authentication password
  // $api->setProxy('some_ip_here'); 
  $api->addHeader('Event: resync');
  $api->setMethod('NOTIFY');
  $api->setFrom('sip:0780100001003@s217.174.178.108:5060');
  $api->setUri('sip:0780100001003@217.174.178.108:5060');
  $res = $api->send();

  echo "response: $res\n";
  
} catch (Exception $e) {
  
  echo $e;
}

?>
