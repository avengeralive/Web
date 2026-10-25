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

    public static function requestLV(Zakaz $zakaz, $comments,$tostatus){
        if($zakaz->user_id != '86') return;

        $url = 'https://sjb.leadvertex.ru/api/admin/updateOrder.html?token=123456&id='.$zakaz->externalId;

        $curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "status=".$tostatus."&comment=".$comments);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
 		$posts = json_decode(curl_exec($curl), true);
        curl_close($curl);
    }

    public static function tgbd($text){
        if(is_array($text)) $text = json_encode($text, true);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

}
