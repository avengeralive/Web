<?php

class Telegram_Command_Auth extends Telegram_Command {
    public function __construct() {
        $this->_name = "\xF0\x9F\x94\x93 Авторизировать Telegram";
    }
    public function run($message) {
        return "\xE2\x9C\x8C Отлично. Для подтверждения аккаунта, перейти по ссылке: https:///profile.php?tele=".$message->from->id."&telehash=".md5($message->from->id."tele333").PHP_EOL."После подтверждения ты сможешь использовать бота в полной мере!";
    }
    
}
