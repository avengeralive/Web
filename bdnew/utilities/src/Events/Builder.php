<?php

class Events_Builder {

    /**
     * Создает инфо блок по событию.
     * @return Events_Info
     * @param Events $e
     */
    public static function factory(Events $e) {
        $host = Registry::get('di')->site['host'];

        if ($e->type == Events::EVENT_OFFER_START) {
            $o = Offer::getById($e->target_id);
            return new Events_Info("Запущен офер \"" . $o->name . "\"", '', file_exists(START_PATH . '/../tmp/offer' . $o->id . '.jpg') ? "https:///tmp/offer" . $o->id . ".jpg" : false, $host . 'offers.php?offer=' . $o->id);
        }
        if ($e->type == Events::EVENT_OFFER_CHANGE_GEO) {
            $o = Offer::getById($e->target_id);
            if ($o->active == 0) {
                return null;
            }
            $info = new Events_Info("Изменение ГЕО в офере \"" . $o->name . "\"", '', file_exists(START_PATH . '/../tmp/offer' . $o->id . '.jpg') ? "https:///tmp/offer" . $o->id . ".jpg" : false, $host . 'offers.php?offer=' . $o->id);
            $info->plain .= PHP_EOL;
            if (!empty($e->customData['added'])) {
                $info->plain .= PHP_EOL . "Добавлены след. гео: " . implode(", ", $e->customData['added']);
            }
            if (!empty($e->customData['removed'])) {
                $info->plain .= PHP_EOL . "Убраны след. гео: " . implode(", ", $e->customData['removed']);
            }
            return $info;
        }
        if ($e->type == Events::EVENT_OFFER_CHANGE_COMISSION) {

            $o = Offer::getById($e->target_id);
            if ($o->active == 0) {
                return null;
            }
            return new Events_Info("Изменение отчислений в офере \"" . $o->name . "\"", '', file_exists(START_PATH . '/../tmp/offer' . $o->id . '.jpg') ? "https:///tmp/offer" . $o->id . ".jpg" : false, $host . 'offers.php?offer=' . $o->id);
        }
        if ($e->type == Events::EVENT_OFFER_STOP) {
            $o = Offer::getById($e->target_id);
            return new Events_Info("Временная остановка офера \"" . $o->name . "\"", '', file_exists(START_PATH . '/../tmp/offer' . $o->id . '.jpg') ? "https:///tmp/offer" . $o->id . ".jpg" : false, $host . 'offers.php?offer=' . $o->id);
        }
        if ($e->type == Events::EVENT_LANDING_NEW) {
            $o = Offer::getById($e->target_id);
            if ($o->active == 0) {
                return null;
            }
            return new Events_Info("Добавлен новый лендинг в офере \"" . $o->name . "\"", '', file_exists(START_PATH . '/../tmp/offer' . $o->id . '.jpg') ? "https:///tmp/offer" . $o->id . ".jpg" : false, $host . 'offers.php?offer=' . $o->id);
        }
        if ($e->type == Events::EVENT_PRELANDING_NEW) {
            $o = Offer::getById($e->target_id);
            if ($o->active == 0) {
                return null;
            }
            return new Events_Info("Добавлен новая транзитная страница в офере \"" . $o->name . "\"", '', file_exists(START_PATH . '/../tmp/offer' . $o->id . '.jpg') ? "https:///tmp/offer" . $o->id . ".jpg" : false, $host . 'offers.php?offer=' . $o->id);
        }
        if ($e->type == Events::EVENT_TICKET_NEW) {
            return new Events_Info("Создан новый тикет в системе службы поддержки.", "ID обращения: " . $e->target_id, false, $host . 'tickets.php?ticket=' . $e->target_id);
        }
        if ($e->type == Events::EVENT_TICKET_REPLY_NEW) {
            return new Events_Info("Добавлен новый ответ по обращению.", "ID обращения: " . $e->target_id, false, $host . 'tickets.php?ticket=' . $e->target_id);
        }
        if ($e->type == Events::EVENT_MONEY_IN) {
            $fl = FinancesLog::getById($e->target_id);
            $u = User::getById($fl->user_id);
            return new Events_Info("Пополнение баланса.", "Счет аккаунта " . $u->email . " пополнен на " . $e->customData['added'] . ' руб. ' . PHP_EOL . 'Новый баланс: ' . $e->customData['balance'] . ' руб.', false, false);
        }
        if ($e->type == Events::EVENT_MONEY_OUT) {
            $fl = FinancesLog::getById($e->target_id);
            $u = User::getById($fl->user_id);
            var_dump($fl);
            return new Events_Info("Заявка на вывод.", "Создана новая заявка на вывод средств №" . $e->target_id . ", пользователь " . $u->email . " подал заявку на вывод средств в размере: " . $fl->summ . ' руб. ', false, false);
        }
        if ($e->type == Events::EVENT_MONEY_OUT_CONFIRM) {
            $fl = FinancesLog::getById($e->target_id);
            $u = User::getById($fl->user_id);
            return new Events_Info("Заявка на вывод.", "Заявка на вывод средств №" . $e->target_id . " успешно выполнена", false, false);
        }
        if ($e->type == Events::EVENT_ORDER_NEW) {
            $lines = [];
            $z = Zakaz::getById($e->target_id);
            $lines[] = 'ID: ' . $z->id;
            $lines[] = 'Оффер: ' . Offer::getById($z->offer_id)->name;
            $lines[] = 'Имя: ' . preg_replace("/[a-zA-ZА-Яа-яё0-9]{3}$/uis", "***", $z->name);
            $lines[] = 'Телефон: ' . preg_replace("/[a-zA-ZА-Яа-яё0-9]{3}$/uis", "***", $z->phone);
            return new Events_Info("Новый лид", implode(PHP_EOL, $lines), false, $host . 'stats.php');
        }
        if ($e->type == Events::EVENT_ORDER_CANCEL) {
            $lines = [];
            $z = Zakaz::getById($e->target_id);
            $lines[] = 'ID: ' . $z->id;
            $lines[] = 'Статус: отмена/треш';
            $lines[] = 'Комментарий: ' . $z->comments;
            return new Events_Info("Лид отменен", implode(PHP_EOL, $lines), false, $host . 'stats.php');
        }
        if ($e->type == Events::EVENT_ORDER_CONFIRM) {
            $lines = [];
            $z = Zakaz::getById($e->target_id);
            $lines[] = 'ID: ' . $z->id;
            $lines[] = 'Статус: подтвержден';
            return new Events_Info("Лид подвержден", implode(PHP_EOL, $lines), false, $host . 'stats.php');
        }
        if ($e->type == Events::EVENT_NEWS_NEW) {
            $lines = [];
            $n = News::getById($e->target_id);
            return new Events_Info("Новость: " . $n->news_zagolovok, strip_tags($n->news), false, $host . 'news.php?news='.$e->target_id);
        }
        return null;
    }

}
