<?php

class CronController {

    public function checkEvents() {
        $events = Events::getNewEvents();

        $admins = User::getAll("id asc", "tip=70 and active=1");
        $support = User::getAll("id asc", "tip=80 and active=1");
        $managers = User::getAll("id asc", "tip=60 and active=1");
        $advertisers = User::getAll("id asc", "tip=40 and active=1");



        $provider_email = new Events_Provider_Email;
        $provider_telegram = new Events_Provider_Telegram;
        $provider_push = new Events_Provider_Push;

        foreach ($events as $event) {

            $info = Events_Builder::factory($event);

            if (!$info) {
                $event->update(['status' => 'done']);
                continue;
            }
            $event->update(['status' => 'sending']);

            // шлем всем админам
            foreach ([$admins, $support, $managers] as $users) {
                foreach ($users as $user) {
                    if (($user->events_email & intval($event->type) ) == intval($event->type)) {
                        $provider_email->send($user, $info);
                    }
                    if (($user->events_telegram & intval($event->type) ) == intval($event->type) && $user->telegram != '') {
                        $provider_telegram->send($user, $info);
                    }
                    if (($user->events_push & intval($event->type) ) == intval($event->type)) {
                        $provider_push->send($user, $info);
                    }
                }

                //
            }

            // Шлем юзерам
            $users = [];
            if ($event->type == Events::EVENT_OFFER_START) {
                $users = User::getAll("id asc", "tip=10 and active=1");
            }
            if ($event->type == Events::EVENT_OFFER_CHANGE_GEO || $event->type == Events::EVENT_OFFER_CHANGE_COMISSION || $event->type == Events::EVENT_OFFER_STOP) {
                $sql = "select distinct user_id from streams where offer_id=" . $event->target_id;
                $stmt = DB::getInstance()->query($sql);
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetchObject()) {
                        $users[] = User::getById($row->user_id);
                    }
                }
            }
            if ($event->type == Events::EVENT_LANDING_NEW) {
                $l = Offer_Landing::getById($event->target_id);
                $sql = "select distinct user_id from streams where offer_id=" . $l->offer_id;
                $stmt = DB::getInstance()->query($sql);
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetchObject()) {
                        $users[] = User::getById($row->user_id);
                    }
                }
            }
            if ($event->type == Events::EVENT_PRELANDING_NEW) {
                $l = Offer_Prelanding::getById($event->target_id);
                $sql = "select distinct user_id from streams where offer_id=" . $l->offer_id;
                $stmt = DB::getInstance()->query($sql);
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetchObject()) {
                        $users[] = User::getById($row->user_id);
                    }
                }
            }
            if ($event->type == Events::EVENT_ORDER_NEW || $event->type == Events::EVENT_ORDER_CONFIRM || $event->type == Events::EVENT_ORDER_CANCEL) {
                $users[] = User::getById($event->customData['user_id']);
                $users[] = User::getById($event->customData['owner_id']);
            }
            if ($event->type == Events::EVENT_NEWS_NEW) {
                $n = News::getById($event->target_id);
                if ($n->offer_id > 0) {
                    $sql = "select distinct user_id from streams where offer_id=" . $event->target_id;
                    $stmt = DB::getInstance()->query($sql);
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetchObject()) {
                            $users[] = User::getById($row->user_id);
                        }
                    }
                } else {
                    $users = User::getAll("id asc", "tip=" . $n->user_tip . " and active=1");
                }
            }
            if (in_array($event->type, [Events::EVENT_MONEY_IN, Events::EVENT_MONEY_OUT, Events::EVENT_MONEY_OUT_CONFIRM])) {
                $fl = FinancesLog::getById($event->target_id);
                $users[] = User::getById($fl->user_id);
            }
            if (in_array($event->type, [Events::EVENT_TICKET_NEW, Events::EVENT_TICKET_REPLY_NEW])) {
                $t = DB::getInstance()->query("select ot_kogo from tickets where id=" . intval($event->target_id))->fetchColumn();
                $users[] = User::getById($t);
            }
            //

            foreach ($users as $user) {
                if (!$user)
                    continue;
                if (($user->events_email & intval($event->type) ) == intval($event->type)) {
                    $provider_email->send($user, $info);
                }
                if (($user->events_telegram & intval($event->type) ) == intval($event->type) && $user->telegram != '') {
                    $provider_telegram->send($user, $info);
                }
                if (($user->events_push & intval($event->type) ) == intval($event->type)) {
                    $provider_push->send($user, $info);
                }
            }
            $event->update(['status' => 'done']);
        }
    }

    public function sendMailing() {
        set_time_limit(0);
        ignore_user_abort(1);

        $mm = new Mailing_Manager(DB::getInstance());
        $mm->where('status', Mailing::STATUS_NEW);
        $mm->where('sendAt', date('Y-m-d H:i:s'), '<');
        $mm->sortBy('sendAt', 'asc');
        $mm->limit(-1);
        $list = $mm->get();
        $di = Registry::get('di');

        $mailerConfig = $di->mailer;

        $sender = Mailing_Sender::factory($mailerConfig['type'], $mailerConfig['config']);

        foreach ($list as $mailing) {
            $mailing->update(['status' => Mailing::STATUS_SENDING]);


            $users = array();
            if ($mailing->group_type == Mailing_Group::GROUP_TYPE_CUSTOM) {
                $group = Mailing_Group::getById($mailing->group_id);
                $users = $group->getUsers(true);
            } else {
                $users = DB::getInstance()->query("select * from users where notify=1 and tip=" . $mailing->group_id)->fetchAll(PDO::FETCH_OBJ);
            }

            $letter = new Mailing_Letter_Spam;
            $letter->setMailingId($mailing->id);

            $letter->setHtml($mailing->body);
            $letter->setSubject($mailing->subject);



            foreach ($users as $user) {
                $letter->setTo($user->email);
                $sender->send($letter);
            }
            $mailing->update(['status' => Mailing::STATUS_DONE]);
        }
    }

}
