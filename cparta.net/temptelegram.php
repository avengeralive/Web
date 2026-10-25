<?php 

define('BOT_TOKEN', '642308419:AAGm4uuDlipG7mH4BvrL2rjMU-nZM-TMPsc');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
	
// read incoming info and grab the chatID
if(!isset($_GET['cid'])){
	$content = file_get_contents("php://input");
	$update = json_decode($content, true);
	$chatID = $update["message"]["chat"]["id"];
		
// compose reply
	$reply = 'Привет. Это временный ТБот. Ваш ИД: '.$chatID;
}
else{
	
	$reply =  $_GET['m'];
	$chatID = $_GET['cid'];
	
}
	
		
// send reply
$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;
file_get_contents($sendto);

function sendMessage($text){
	$message = $text;
	return $message;
}