<?php

// ! set webhook first
// https://api.telegram.org/bot942550807:AAHp-TIZscXnFlH_UDnmXVS848dRL9-OU6s/setWebhook?url=https://vinetsky.com/bot/bot.php
require_once "vendor/autoload.php";
define('TG_TOKEN', '942550807:AAHp-TIZscXnFlH_UDnmXVS848dRL9-OU6s');
// define('TG_CHAT', '50372987');


$token = TG_TOKEN;
// $chatId = TG_CHAT;
$bot = new \TelegramBot\Api\Client($token);

// $bot->sendMessage(TG_CHAT, 'hi there');

function getTgPassword(){
	return 'tuktuk';
}

function getTgUsers(){
	$userlist = file_get_contents(__DIR__ . '/bot/users.txt');
	return $userlist;
}

function checkTgUser($user){
	$userlist = getTgUsers();
	if (strstr($userlist, $user."")) {
		return true;
	}

	return false;
}

function authorizeTgUser($user){
	file_put_contents(__DIR__ . '/bot/users.txt', $user."\n", FILE_APPEND );
}

function getUserId($message){
	return $message->getFrom()->getId();
}

function broadcastTg($bot){
	$userlist = explode('\n', getTgUsers());
	for ($i=0; $i < count($userlist); $i++) {
		$message = "That's some <b>secret</b> info!";
		if ($userlist[$i] != "") $bot->sendMessage($userlist[$i], $message, 'HTML');
	}
}


ob_start();
// команда для start
$bot->command('start', function ($message) use ($bot) {
	// $answer = 'Добро пожаловать!';
	$user = getUserId($message);
	$username = $message->getFrom()->getFirstName()." ".$message->getFrom()->getLastName().' ['.$user.']';
	if (checkTgUser($user)) {
		$answer = "Пользователь $username уже авторизован. Спасибо, что вы снова с нами!";
	} else {
		$text = $message->getText();
		$param = str_replace('/start', '', $text);
		$param = trim($param);

		if ($param == "") {
			$answer = "Пользователь $username не авторизован, введите /start <пароль> чтобы подключиться";
		} else if ($param == getTgPassword()) {
			authorizeTgUser($user);
			$answer = "Пользователь $username был авторизован.";
		} else {
			$answer = "Пароль '$param' неправильный.";
		}
	}

	// var_dump($message->getFrom()->getUsername());
	$b = ob_get_contents();

	 $bot->sendMessage($message->getChat()->getId(), $answer."\n\n".$b);
});

// broadcastTg($bot);

// команда для помощи
$bot->command('help', function ($message) use ($bot) {
    $answer = 'Команды:
/help - вывод справки';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

$bot->run();
ob_end_clean();




?>