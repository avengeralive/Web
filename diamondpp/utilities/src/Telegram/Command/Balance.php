<?php

class Telegram_Command_Balance extends Telegram_Command {
    public function __construct() {
        $this->_name = "\xF0\x9F\x94\xA5 Баланс";
    }
    public function run($message) {
        $db = DB::getInstance();
        $u = $db->query("select hold,balance from users where telegram=".$message->from->id);
        $row = $u->fetchObject();
        return "\xF0\x9F\x94\xA5 Холд: {$row->hold} руб, Баланс: {$row->balance} руб. ";
    }
    
}
