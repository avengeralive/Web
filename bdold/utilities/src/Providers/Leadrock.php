<?php

class Providers_Leadrock {

    protected static function request($url, $requestQuery) {


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestQuery));

        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);     

            $logger = Registry::get('di')->logger;
            $logger->custom('LEADrock', var_export($result));
        
        return $result;
    }
    
    public static function getTrack($webLink, $ip, $ua) {
        return file_get_contents($webLink . '?ajax=1&ip='.$ip.'&ua='.$ua);
    }
    
    public static function registerLead($webLink, $zakaz, $key, $secret) {
        
        $a = '631chyf1hyte32twe35a7628a03';

        $arHash = [ 
            $zakaz->user_id,
            $zakaz->id,
            $a
        ];

        $sign_hash = md5(implode(":", $arHash));
        
        $params = [
            'flow_url' => $webLink,
            'user_phone' => $zakaz->phone,
            'user_name' => $zakaz->name,
            'other' => '',
            'ip' => $zakaz->ip,
            'ua' => $zakaz->useragent,
            'api_key' => $key,
            'sub1' => $zakaz->id,
            'sub2' => $sign_hash
        ];
        $url = 'https://leadrock.com/api/v2/lead/save';
        
        $track_id = self::getTrack($webLink, $zakaz->ip, $zakaz->useragent);

        $trackUrl = $params['flow_url'] . (strpos($params['flow_url'], '?') === false ? '?' : '') . '&ajax=1';
        foreach ($params as $param => $value) {
            if (strpos($param, 'sub') === 0) {
                $trackUrl .= '&' . $param . '=' . $value;
                unset($params[$param]);
            }
        }
        
        $params['track_id'] = $track_id;

        $params['sign'] = sha1(http_build_query($params) . $secret);
                
        $res = self::request($url, $params);  

        if (!isset($res['error']) || $res['error'] != false) {
            throw new Exception("Не принят");
        }
        return $zakaz->id;
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($key, $secret) {
        return true;
        $params = [
            'limit' => 100,
            'api_key' => $key,
        ];
        $url = 'https://leadrock.com/api/v2/lead/list';

        $params['sign'] = sha1(http_build_query($params) . $secret);
                
        $res = self::request($url, $params);  

        return $res;
    }
}
