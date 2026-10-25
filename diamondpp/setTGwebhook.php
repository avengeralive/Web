<?php
require dirname(__FILE__) . '/utilities/bootstrap.php';

//use Clue\React\Socks\Client;
//use React\Socket\Connector;
//use React\EventLoop\Factory;
use Telegram\Bot\Api;

$key = Registry::get('di')->telegram['KEY'];
$proxy = Registry::get('di')->proxy;
/*
$loop = Factory::create();

$pr = new Client('socks5://8wbjvO:irVCWf1TOQ@188.130.128.150:8061', new Connector($loop));
$handler = new HttpClientRequestHandler($loop, [
    'tcp' => $pr,
    'timeout' => 3.0,
    'dns' => false
]);


$setWebhook = new SetWebhook();
$setWebhook->url = 'https://yes-cpa.com/utilities/telegram.php';

$tgLog = new TgLog($key, $handler);
$tgLog->performApiRequest($setWebhook);

*/

$telegram = new Api($key);
$response = $telegram->setWebhook(['url' => 'https://yes-cpa.com/utilities/telegram.php?token='.$key]);