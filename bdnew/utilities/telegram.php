<?php

require dirname(__FILE__) . '/bootstrap.php';
$key = Registry::get('di')->telegram['KEY'];
//$proxy = Registry::get('di')->proxy;

//use Clue\React\Socks\Client;
//use React\Socket\Connector;
//use React\EventLoop\Factory;
use Telegram\Bot\Api;
/*
$loop = Factory::create();

$pr = new Client('socks5://8wbjvO:irVCWf1TOQ@188.130.128.150:3001', new Connector($loop));
$handler = new HttpClientRequestHandler($loop, [
    'tcp' => $pr,
    'timeout' => 3.0,
    'dns' => false
]);
*/

$income = json_decode(file_get_contents('php://input'));

$tId = $income->message->from->id;
$in = $income->message->text;

$api = new Api($key);

//$sendMessage = new SendMessage();

$db = DB::getInstance();
//$stmt = $db->query("select id from users where")

$unAuthCommands = [
    [
        new Telegram_Command_Auth(),
    ],
    [
        new Telegram_Command_Register()
    ]
];
$AuthCommands = [
    [new Telegram_Command_Balance()],
    [new Telegram_Command_StatToday(), new Telegram_Command_StatYesterday()],
    [new Telegram_Command_Stat7Days(), new Telegram_Command_Autologin()],
    
];
$isAuth = DB::getInstance()->query("select id from users where telegram=" . intval($tId))->rowCount() > 0;
if (!$isAuth) {
    $commands = $unAuthCommands;
} else {
    $commands = $AuthCommands;
}

$message = "\xF0\x9F\x98\xB3 я обычный бот, ничего, кроме комманд, не понимаю...";
array_walk_recursive($commands, function(&$el) use ($in, &$message, $income) {
    $l = Registry::get('di')->logger;
    $l->custom('teledump', ( (string) $el) . " / " . $in);
    if ((string) $el == $in) {
        $l->custom('teledump', 'YES');
        $message = $el->run($income->message);
    }
});

//$sendMessage->chat_id = $tId; //$tId;
//$sendMessage->text = $message;

/*
$sendMessage->reply_markup = new ReplyKeyboardMarkup();
array_walk_recursive($commands, function(&$el) {
    $el = (string) $el;
});
$sendMessage->reply_markup->keyboard = $commands;
*/
array_walk_recursive($commands, function(&$el) {
    $el = (string) $el;
});
$reply_markup = $api->replyKeyboardMarkup([
    'keyboard' => $commands,
    'resize_keyboard' => true, 
    'one_time_keyboard' => true
]);

try {
    //$api->performApiRequest($sendMessage);
    
    $response = $api->sendMessage([
        'chat_id' => $tId, 
        'text' => $message,
        'reply_markup' => $reply_markup
    ]);

    $messageId = $response->getMessageId();
    
} catch (ClientException $e) {
    die();
}
