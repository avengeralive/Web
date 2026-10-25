<?php

class Telegram_Command_Register extends Telegram_Command {
    public function __construct() {
        $this->_name = "\xF0\x9F\x8C\xB4 Регистрация в Yes CPA";
    }
    public function run($message) {
        return "\xF0\x9F\x8C\xB4! Регистрация очень простая!".PHP_EOL."Перейди по ссылке https:/// и заполни анкету.".PHP_EOL."Займет всего пару минут \xF0\x9F\x98\x8A";
    }
    
}
