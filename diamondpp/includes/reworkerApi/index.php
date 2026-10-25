<?php

class ReworkerApi {

    function SendOrder($shop_id, $name, $phone, $userTo, $price, $sku) {
        $apiKey = '4eb32e1ff759015f18e01c561393045a';
        $url = 'http://www.reworker.ru/clients/api/lead_postback.php';
        if ($name == '') {
            $name = 'Заказчик';
        }
        if ($phone == '') {
            $phone = 0;
        }

        $data = array(
            'reworker_client_id' => $userTo,
            'reworker_shop_id' => $shop_id,
            'order_product_count' => 1,
            'order_product_price' => $price,
            'order_product_sku' => $sku,
            'order_name' => $name,
            'order_phone' => $phone
        );
        $requestQuery = http_build_query($data);

        $send = $this->postCurlData($url, $requestQuery);
        return $send;
    }

    function GetOrder($order, $userTo) {
        $apiKey = '4eb32e1ff759015f18e01c561393045a';
        $url = 'http://reworker.ru/clients/api/lead_status.php';
        $data = array(
            'reworker_client_id' => $userTo,
            'order_ids' => $order,
            'comments' => true
        );
        $requestQuery = http_build_query($data);

        $send = $this->postCurlData($url, $requestQuery);
        return $send;
    }

    function postCurlData($url, $requestQuery) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        //curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestQuery);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        return $result;
    }

}
