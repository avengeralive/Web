<?php

class Telegram_Command_Payout extends Telegram_Command {
    public function __construct() {
        $this->_name = "\xF0\x9F\x92\xB0 Заказать выплату";
    }
    public function run($message) {
        return "\xF0\x9F\x92\xB0 заявка на выплату подана. ";
    }
    
}
