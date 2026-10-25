<?php

class Telegram_Command_Autologin extends Telegram_Command {
    public function __construct() {
        $this->_name = "\xF0\x9F\x94\x91 Войти";
    }
    public function run($message) {
        $db = DB::getInstance();
        $u = $db->query("select id from users where telegram=".$message->from->id);
        $id = $u->fetchColumn();
        $url = "https:///?al&id=".$id."&hash=".md5($id."autologin123123");
        return "\xF0\x9F\x94\x91 Ссылка для входа: $url ".PHP_EOL."Держи эту ссылку в тайне \xF0\x9F\x91\x8A";
    }
    
}
