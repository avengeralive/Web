<?php

abstract class Offer_Pinger {

    /**
     * Конкретный оффер
     * @var Offer
     */
    protected $offer;

    public function setOffer(Offer $offer) {
        $this->offer = $offer;
        return $this;
    }

    /**
     * Пингует удаленную партнерку, передает настройки поля pinger_value, и созданный заказ
     * 
     */
    abstract function ping($settings, Zakaz $zakaz);

    abstract function checkStatus(Zakaz $zakaz);
    
}
