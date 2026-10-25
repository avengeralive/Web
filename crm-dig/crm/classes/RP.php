<?php


class RP
{

    public static $API_URL = 'https://otpravka-api.pochta.ru';
    public static $API_AUTH = 'BPHL0_nadxNJ2rMAhmDNbJ2DF5ouzbbX';
    public static $API_USER = 'bW9iaS5wcm9ncmVzc0Biay5ydTpLSkdIS0pHNDM2';
//    public static $API_INDEX_FROM = '102961';
    public static $API_INDEX_FROM = '141020';

    const BATCH_NEW = 0;
    const BATCH_CHECKED = 1;
    const BATCH_COURIER = 2;
    const BATCH_NO_COURIER = 3;

    public static $batchStates = [
        self::BATCH_NEW => 'Новая',
        self::BATCH_CHECKED => 'Финализирована',
        self::BATCH_COURIER => 'С вызовом курьера',
        self::BATCH_NO_COURIER => 'Без вызова курьера',
    ];


    public static $tariffs = [
        'POSTAL_PARCEL' => 'Посылка',
        'ONLINE_PARCEL' => 'Посылка Онлайн',
        'PARCEL_CLASS_1' => 'Посылка 1 класса',
//        'ONLINE_COURIER' => 'Курьер Онлайн',
    ];

    public static $tariffsNoFirst = [
        'POSTAL_PARCEL' => 'Посылка',
        'ONLINE_PARCEL' => 'Посылка Онлайн',
//        'PARCEL_CLASS_1' => 'Посылка 1 класса',
//        'ONLINE_COURIER' => 'Курьер Онлайн',
    ];

    public static $cod_receivers = [
        1 => 'PIMPAY',
        2 => 'Mobi деньги',
        3 => 'PIMPAY - А-Т',
        4 => 'Mobi деньги - А-Т',
        5 => 'СДТ - Пим',
        6 => 'СДТ - Мобимани',
        7 => 'ССДТ-пим',
        8 => 'ССДТ-моби',
        9 => 'СВ-МОБИ',
        10 => 'Р/с Сфера',
        11 => 'ООО Прогресс - Альфа Р/С',
        12 => 'ООО Прогресс - Моби',
        13 => 'ООО Прогресс - моби Лабиринт',
        14 => 'Авалид - Альфа р/с',
        15 => 'Авалид - моби Лабиринт',
        16 => 'Вега ПИМ',
        17 => 'Вега моби лабиринт',
        18 => 'Сфера - моби Лабиринт',
        19 => 'Венера - альфа р\с',
        20 => 'Венера - моби Лабиринт',
        21 => 'Просвет - альфа р\с',
        22 => 'Просвет - моби Лабиринт',
        23 => 'Маркетплейс рус-  р\с',
        24 => 'Маркетплейс рус - моби Лабиринт',
        25 => 'Амарит -  р\с',
        26 => 'Амарит  - моби Лабиринт',
        27 => 'Глория -  р\с',
        28 => 'Глория  - моби Лабиринт',
    ];


    const LOGGING = true;


    public static function sendGetRequest($url, $params = null, $headers = [], $connect_timeout = 10, $timeout = 10)
    {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url.($params ? http_build_query($params) : ''),
            CURLOPT_POST           => 0,
            CURLOPT_CONNECTTIMEOUT => $connect_timeout,
            CURLOPT_TIMEOUT        => $timeout,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }


    public static function sendPostRequest($url, $request, $headers = [])
    {

        $headers = array_merge($headers, ['Connection: close']);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_POST           => 1,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_POSTFIELDS     => $request,
            CURLOPT_CONNECTTIMEOUT => 600,
            CURLOPT_TIMEOUT        => 600,
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($curl);

//    $info = curl_getinfo($curl);
//    file_put_contents('rp.order', "curl - ".print_r($info, true)."\n\n", FILE_APPEND);

        curl_close($curl);

        return $response;

    }


    public static function sendPutRequest($url, $request, $headers = [])
    {


        $headers = array_merge($headers, ['Connection: close']);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
//        CURLOPT_POST           => 1,
            CURLOPT_CUSTOMREQUEST  => 'PUT',
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_POSTFIELDS     => $request,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }


    public static function json_print($var, $no_pretty = false, $print = false) {
        if ($no_pretty)
            $result = json_encode($var, JSON_UNESCAPED_UNICODE).PHP_EOL;
        else
            $result = json_encode($var, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT).PHP_EOL;

        if ($print) echo $result;
        return $result;
    }


    public static function getShipmentPoints($auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL.'/1.0/user-shipping-points', [], $headers);

        return json_decode($response, true);

    }


    public static function getSettings($auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL.'/1.0/settings', [], $headers);

        return json_decode($response, true);

    }


    public static function calculateTariff($indexTo, $weight, $value, $mail_type = 'POSTAL_PARCEL', $auth = null, $user = null, &$log = null) {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $body = json_encode([
            'declared-value' => $value*100,
            'fragile' => 'false',
            'index-from' => self::$API_INDEX_FROM,
            'index-to' => $indexTo,
            'mail-category' => 'WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY',
            'mail-type' => $mail_type,
            'mass' => $weight,
        ]);

        if ($log) $log .= json_encode($headers)."\n     $body\n";
        else file_put_contents('rp.calculate.log', json_encode($headers)."\n     $body\n", FILE_APPEND);

        $response = self::sendPostRequest(self::$API_URL.'/1.0/tariff', $body, $headers);

        return json_decode($response, true);

    }


    public static function getOrder($term, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL.'/1.0/backlog/'.$term, [], $headers);

        return json_decode($response, true);

    }


    public static function getOrderByBarcode($barcode, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL.'/1.0/shipment/search?query='.$barcode, [], $headers);

        return json_decode($response, true);

    }


    public static function createOrder($order, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        file_put_contents('rp.create.order.log', date('Y-m-d H:i:s'). ' create RP order'.PHP_EOL, FILE_APPEND);
        file_put_contents('rp.create.order.log', "   auth: ($auth, $user)".PHP_EOL, FILE_APPEND);
        file_put_contents('rp.create.order.log', '   data: '.RP::json_print($order, false).PHP_EOL, FILE_APPEND);

        $response = self::sendPutRequest(self::$API_URL.'/1.0/user/backlog', json_encode($order), $headers);

        file_put_contents('rp.create.order.log', '   response: '.$response.PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND);

        return json_decode($response, true);

    }


    public static function updateOrder($id, $order, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendPutRequest(self::$API_URL.'/1.0/backlog/'.$id, json_encode($order), $headers);

        return json_decode($response, true);

    }


    public static function getOrderForms($id, $auth = null, $user = null) {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL."/1.0/forms/backlog/$id/forms", [], $headers);

        return $response;

    }


    public static function createBatch($date_shipment, $orders, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        file_put_contents('rp.batches.log', date('Y-m-d H:i:s'). ' create RP batch'.PHP_EOL, FILE_APPEND);
        file_put_contents('rp.batches.log', '   creds: '.$auth.', '.$user.PHP_EOL, FILE_APPEND);
        file_put_contents('rp.batches.log', '   date shipment: '.$date_shipment.PHP_EOL, FILE_APPEND);
        file_put_contents('rp.batches.log', '   data: '.RP::json_print($orders, false).PHP_EOL, FILE_APPEND);

        $response = self::sendPostRequest(self::$API_URL.'/1.0/user/shipment?sending-date='.$date_shipment, json_encode($orders), $headers);

        file_put_contents('rp.batches.log', '   response: '.PHP_EOL.$response.PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND);

        return json_decode($response, true);

    }


    public static function getLastBatches($number, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL."/1.0/batch?sort=desc&size=".$number, [], $headers);

        return json_decode($response, true);

    }


    public static function getBatch($batch_number, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL."/1.0/batch/".$batch_number, [], $headers);

        return json_decode($response, true);

    }


    public static function getBatchOrders($batch_number, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL."/1.0/batch/$batch_number/shipment", [], $headers);

        return json_decode($response, true);

    }


    public static function checkinBatch($batch_number, $auth = null, $user = null, $useOnlineBalance = true)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendPostRequest(self::$API_URL."/1.0/batch/$batch_number/checkin".($useOnlineBalance?'?useOnlineBalance=true':''), [], $headers);

        file_put_contents('rp.batches.log', "Checkin $batch_number: ".PHP_EOL.$response.PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND);

        return json_decode($response, true);

    }


    public static function courierFindAddresses($mail_type, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL."/1.0/courier/$mail_type/find-addresses", [], $headers);

        return json_decode($response, true);

    }


    public static function courierFindDates($address_id, $mail_type, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL."/1.0/courier/$address_id/$mail_type/find-dates", [], $headers);

        return json_decode($response, true);

    }


    public static function courierOrder($order, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendPutRequest(self::$API_URL.'/1.0/user/backlog', json_encode($order), $headers);

        file_put_contents('rp.courier.order.log', date('Y-m-d H:i:s'). ' create courier order'.PHP_EOL, FILE_APPEND);
        file_put_contents('rp.courier.order.log', "   auth: ($auth, $user)".PHP_EOL, FILE_APPEND);
        file_put_contents('rp.courier.order.log', '   data: '.RP::json_print($order, false).PHP_EOL, FILE_APPEND);
        file_put_contents('rp.courier.order.log', '   response: '.$response.PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND);

        return json_decode($response, true);

    }


    public static function getF103($batch_number, $auth = null, $user = null)
    {

        $headers = [
            'authorization: AccessToken '.(!empty($auth) ? $auth : self::$API_AUTH),
            'x-user-authorization: Basic '.(!empty($user) ? $user : self::$API_USER),
            'content-type: application/json;charset=UTF-8'
        ];

        $response = self::sendGetRequest(self::$API_URL."/1.0/forms/$batch_number/f103pdf", [], $headers);

        return $response;

    }



//--------------------------------------------------------
// Функция для преобразования числа в сумму прописью
//--------------------------------------------------------
// Автор: ManHunter / PCL (www.manhunter.ru)
//--------------------------------------------------------
    private static function num2word($n,$words) {
        return ($words[($n=($n=$n%100)>19?($n%10):$n)==1?0 : (($n>1&&$n<=4)?1:2)]);
    }
    public static function sum2words($n) {
        $words=array(
            900=>'девятьсот',
            800=>'восемьсот',
            700=>'семьсот',
            600=>'шестьсот',
            500=>'пятьсот',
            400=>'четыреста',
            300=>'триста',
            200=>'двести',
            100=>'сто',
            90=>'девяносто',
            80=>'восемьдесят',
            70=>'семьдесят',
            60=>'шестьдесят',
            50=>'пятьдесят',
            40=>'сорок',
            30=>'тридцать',
            20=>'двадцать',
            19=>'девятнадцать',
            18=>'восемнадцать',
            17=>'семнадцать',
            16=>'шестнадцать',
            15=>'пятнадцать',
            14=>'четырнадцать',
            13=>'тринадцать',
            12=>'двенадцать',
            11=>'одиннадцать',
            10=>'десять',
            9=>'девять',
            8=>'восемь',
            7=>'семь',
            6=>'шесть',
            5=>'пять',
            4=>'четыре',
            3=>'три',
            2=>'два',
            1=>'один',
        );

        $level=array(
            4=>array('миллиард', 'миллиарда', 'миллиардов'),
            3=>array('миллион', 'миллиона', 'миллионов'),
            2=>array('тысяча', 'тысячи', 'тысяч'),
        );

        list($rub,$kop)=explode('.',number_format($n,2));
        $parts=explode(',',$rub);

        for($str='', $l=count($parts), $i=0; $i<count($parts); $i++, $l--) {
            if (intval($num=$parts[$i])) {
                foreach($words as $key=>$value) {
                    if ($num>=$key) {
                        // Fix для одной тысячи
                        if ($l==2 && $key==1) {
                            $value='одна';
                        }
                        // Fix для двух тысяч
                        if ($l==2 && $key==2) {
                            $value='две';
                        }
                        $str.=($str!=''?' ':'').$value;
                        $num-=$key;
                    }
                }
                if (isset($level[$l])) {
                    $str.=' '.self::num2word($parts[$i],$level[$l]);
                }
            }
        }

        if (intval($rub=str_replace(',','',$rub))) {
            $str.=' '.self::num2word($rub,array('рубль', 'рубля', 'рублей'));
        }

        $str.=($str!=''?' ':'').$kop;
        $str.=' '.self::num2word($kop,array('копейка', 'копейки', 'копеек'));

        return mb_strtoupper(mb_substr($str,0,1,'utf-8'),'utf-8').
            mb_substr($str,1,mb_strlen($str,'utf-8'),'utf-8');
    }


}
