<?php

class Providers_LpCrm {

    protected static function request($method, $vars=array()) {
        $url = 'http://oae.lp-crm.biz/api/'.$method.'.html';
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        $data = curl_exec($ch);
        return json_decode($data);
    }

    public static function registerLead($prod_id, $apikey, $zakaz) {


        // формируем массив с товарами в заказе (если товар один - оставляйте только первый элемент массива)
        $products_list = array(
            0 => array(
                    'product_id' => $prod_id,    //код товара (из каталога CRM)
                    'price'      => $zakaz->price, //цена товара 1
                    'count'      => '1',                     //количество товара 1
            )
        );

        $products = urlencode(serialize($products_list));
        $sender = urlencode(serialize($_SERVER));
        // параметры запроса
        $data = array(
            'key'             => $apikey, //Ваш секретный токен
            'order_id'        => number_format(round(microtime(true)*10),0,'.',''), //идентификатор (код) заказа (*автоматически*)
            'country'         => 'ALL',                     // Географическое направление заказа
            //'office'          => '1',                          // Офис (id в CRM)
            'products'        => $products,                    // массив с товарами в заказе
            'bayer_name'      => $zakaz->name,            // покупатель (Ф.И.О)
            'phone'           => $zakaz->phone,           // телефон
            //'email'           => $_REQUEST['email'],           // электронка
            //'comment'         => $_REQUEST['product_name'],    // комментарий
            //'delivery'        => $_REQUEST['delivery'],        // способ доставки (id в CRM)
            //'delivery_adress' => $_REQUEST['delivery_adress'], // адрес доставки
            //'payment'         => '',                           // вариант оплаты (id в CRM)
            'sender'          => $sender,
            'utm_source'      => 'AR-CPA',  // utm_source
            //'utm_medium'      => $_SESSION['utms']['utm_medium'],  // utm_medium
            //'utm_term'        => $_SESSION['utms']['utm_term'],    // utm_term
            'utm_content'     => $zakaz->user_id, // utm_content
          //  'utm_campaign'    => $_SESSION['utms']['utm_campaign'],// utm_campaign
          //  'additional_1'    => '',                               // Дополнительное поле 1
          //  'additional_2'    => '',                               // Дополнительное поле 2
          //  'additional_3'    => '',                               // Дополнительное поле 3
          //  'additional_4'    => ''                                // Дополнительное поле 4
        );

        $res = self::request('addNewOrder', $data);
        $logger = Registry::get('di')->logger;
        $logger->custom('LPCRM', serialize($res));
        if (!isset($res->status) || $res->status != 'ok') {
            throw new Exception("Не принят");
        }
        return $res->data[0]->order_id;
    }

    public static function getPaymentStatus($apikey, $id) {
        return true;
    }

    public static function getStatus($apikey, $id) {
        // параметры запроса
        $data = array(
            'key'      => $apikey, //Ваш секретный токен
            'order_id' => $id //(можно передать несколько через запятую) максимально 100 записей!
        );
        // запрос
        $res = self::request('getOrdersByID', $data);

        $logger = Registry::get('di')->logger;
        $logger->custom('LPCRM', serialize($res));

        if (!isset($res->status) || $res->status != 'ok')) {
            throw new Exception("Bad Request");
        }

        return $res->data[0];

    }

}
