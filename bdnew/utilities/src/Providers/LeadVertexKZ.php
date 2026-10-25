<?php

class Providers_LeadVertexKZ {

    protected static function request($http_method, $method, $sub, $webmasterId, $token, $vars = array()) {
		$logger = Registry::get('di')->logger;
		$logger->custom('LVKZ', " *** Запустился реквест *** ");
        $url = 'https://kz-main.leadvertex.ru/api/webmaster/v2/addOrder.html?webmasterID=30&token=qwe123';
        if ($http_method == 'get') {
            $url .= '&' . http_build_query($vars);
        }
        $ch = curl_init($url);
        if ($http_method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
		$data = json_decode($data);
		$logger->custom('LVKZ', " *** Результат отправленного запроса: *** ". var_export($data,1));
		return $data;
    }

    public static function registerLead($sub, $webmasterId, $token, $zakaz, $offername) {
		$logger = Registry::get('di')->logger;
		$logger->custom('LVKZ', " *** Запустился регистрлид *** ");
        $vars = array();
        $vars['fio'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['comment'] = $zakaz->artikul;
        $vars['ip'] = $zakaz->ip;
        $vars['country'] = $zakaz->country;
        $vars['region'] = $zakaz->region;
        $vars['city'] = $zakaz->town;
        $vars['price'] = $zakaz->cena;
        
//        if($zakaz->owner_id == 74){
//            $vars['total'] = $zakaz->cena;
 //           $vars['additional1'] = $zakaz->id;
//            $vars['additional2'] = $offername;
 //           $vars['additional5'] = $zakaz->user_id;
//        }
//	if($zakaz->owner_id == 1035){
//            $vars['price'] = $zakaz->cena;
//            $vars['total'] = $zakaz->cena;
//
 //           $vars['domain'] = Offer_Landing::getById( $zakaz->landing_id )->url;
//            $vars['additional1'] = $zakaz->user_id;
 //           $vars['additional2'] = $zakaz->id;
//        }
//	if($zakaz->owner_id == 1806){
 //           $vars['price'] = $zakaz->cena;
//            $vars['total'] = $zakaz->cena;
//
 //           $vars['domain'] = Offer_Landing::getById( $zakaz->landing_id )->url;
 //           $vars['additional1'] = $offername;
//            $vars['additional10'] = $zakaz->user_id;
//            $vars['additional12'] = $zakaz->id;
 //       }

        $res = self::request('post', 'addOrder', $sub, $webmasterId, $token, $vars);

        if (!isset($res->OK)) {
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $res);
            throw new Exception("Не принят");
        }
        return $res->OK;
    }

    public static function getPaymentStatus($sub, $webmasterId, $token, $id) {
        $res = self::request('get', 'getOrdersByIds', $sub, $webmasterId, $token, ['ids' => $id]);
        if (!isset($res->$id)) {
            throw new Exception("Bad Request");
        }
        $data = $res->$id;
        return $data->payment->status;
    }

    public static function getStatus($sub, $webmasterId, $token, $id) {
        $res = self::request('get', 'getOrdersByIds', $sub, $webmasterId, $token, ['ids' => $id]);
        if (!isset($res->$id)) {
            throw new Exception("Bad Request");
        }
        $data = $res->$id;
        return $data;
    }

}
rn $data;
    }

}?>
