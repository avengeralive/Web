<?php

class Telegram_Command_StatYesterday extends Telegram_Command {

    public function __construct() {
        $this->_name = "\xF0\x9F\x93\x88 Вчера";
    }

    public function run($message) {
        $db = DB::getInstance();
        $u = $db->query("select id from users where telegram=" . $message->from->id);
        $id = $u->fetchColumn();

        $lines = [];

        $start = date("Y-m-d 00:00:00", strtotime("yesterday"));
        $end = date("Y-m-d 23:59:59", strtotime("yesterday"));
        $sql = "select count(distinct ip) as hosts, count(*) as hits from clients_log where date between '$start' and '$end' and user_id=" . $id;
        $row = $db->query($sql)->fetchObject();
        if (!isset($row->hosts)) {
            $row = new stdClass();
            $row->hosts = 0;
            $row->hits = 0;
        }
        $lines[] = 'Хостов: ' . $row->hosts . ", Хитов: " . $row->hits . PHP_EOL;

        $sql = "select count(*) from zakaz where date between '$start' and '$end' and user_id=" . $id;
        $row = intval($db->query($sql)->fetchColumn());
        $line = 'Всего лидов: ' . $row . PHP_EOL;
        $line .= "Ожидание: " . ($db->query("select count(*) from zakaz where date between '$start' and '$end' and user_id=" . $id . " and status=1")->fetchColumn()) . ", сумма: " . intval($db->query("select sum(comission) from zakaz where date between '$start' and '$end' and user_id=" . $id . " and status=1")->fetchColumn()) . ' руб. ' . PHP_EOL;
        $line .= "Подтверждение: " . ($db->query("select count(*) from zakaz where date between '$start' and '$end' and user_id=" . $id . " and status in (2,3)")->fetchColumn()) . ", сумма: " . intval($db->query("select sum(comission) from zakaz where date between '$start' and '$end' and user_id=" . $id . " and status in(2,3)")->fetchColumn()) . ' руб. ' . PHP_EOL;
        $line .= "Отмена/Треш: " . ($db->query("select count(*) from zakaz where date between '$start' and '$end' and user_id=" . $id . " and status in (0,5)")->fetchColumn()) . PHP_EOL;
        $lines[] = $line;

        return "\xF0\x9F\x93\x88 Cводка за вчера: " . PHP_EOL . implode(PHP_EOL, $lines);
    }

}
