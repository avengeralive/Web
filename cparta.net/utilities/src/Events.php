<?php

class Events extends Entity {

    const EVENT_OFFER_START = 1;            //+++
    const EVENT_OFFER_CHANGE_GEO = 2;       //+++
    const EVENT_OFFER_CHANGE_COMISSION = 4; //+++
    const EVENT_OFFER_STOP = 8;             //+++
    const EVENT_ORDER_NEW = 16;             //+++
    const EVENT_ORDER_CONFIRM = 32;         //+++
    const EVENT_ORDER_CANCEL = 64;          //+++
    const EVENT_NEWS_NEW = 128;             //+++
    const EVENT_MONEY_OUT = 256;            //+++
    const EVENT_MONEY_OUT_CONFIRM = 512;    //+++
    const EVENT_MONEY_IN = 1024;            //+++
    const EVENT_TICKET_NEW = 2048;          //+++
    const EVENT_TICKET_REPLY_NEW = 4096;    //+++
    const EVENT_LANDING_NEW = 8192;         //+++
    const EVENT_PRELANDING_NEW = 16384;     //+++

    public static $_desc = [
        self::EVENT_OFFER_START => 'Запуск нового офера',
        // self::EVENT_OFFER_CHANGE_GEO => "Изменение гео офера",
        self::EVENT_OFFER_CHANGE_COMISSION => "Изменение отчислений",
        self::EVENT_OFFER_STOP => "Остановка офера",
        // self::EVENT_ORDER_NEW => "Новый лид",
        self::EVENT_ORDER_CONFIRM => "Подтверждение лида",
        // self::EVENT_ORDER_CANCEL => "Отмена лида",
        self::EVENT_NEWS_NEW => "Новая новость",
        // self::EVENT_MONEY_OUT => "Заявка на вывод средств",
        self::EVENT_MONEY_OUT_CONFIRM => "Подтверждение заявки на вывод средств",
        // self::EVENT_MONEY_IN => "Пополнение баланса",
        // self::EVENT_TICKET_NEW => "Новый тикет",
        self::EVENT_TICKET_REPLY_NEW => "Ответ на тикет",
        // self::EVENT_LANDING_NEW => "Новый лендинг",
        // self::EVENT_PRELANDING_NEW => "Новый прелендинг (транзит)",
    ];

    public static function tableName() {
        return 'events';
    }

    public static function trigger($type, $id, $customData = []) {
        $el = new static;
        $el->type = $type;
        $el->target_id = $id;
        $el->customData = json_encode($customData);
        $el->created = date("Y-m-d H:i:s", time());
        $el->status = 'new';
        return $el->create();
    }

    public function setRow($row) {
        parent::setRow($row);
        $this->customData = @json_decode($this->customData, true);
        if (!$this->customData || json_last_error()) {
            $this->customData = [];
        }
        return $this;
    }

    public static function getNewEvents() {
        return static::getAll("created desc", "status='new'");
    }
    

    public static function getCabinetEvents() {
        return static::getAll("created desc limit 10", "type <= 8 or type = 8192 or type = 16384");
    }

}
