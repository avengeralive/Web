<?php


class AccordPost
{

//    const API_URL = 'https://api.accordpost.ru/stage/ff/v2/wsrv';
    const API_URL = 'https://api.accordpost.ru/ff/v2/wsrv';
    const TEST_PARTNER_ID = 300;
    const TEST_PASSWORD = '300';

    const PROD_PARTNER_ID = 716;
    const PROD_PASSWORD = 'Rgusb4j6';
    const PROD_BLNP_ID = 593;

    public static $rpTariffs = [
        4 => 'Посылка',
        23 => 'Посылка-Онлайн',
        47 => 'Посылка 1 класса',
    ];

    public static $rpTariffsCodes = [
        'POSTAL_PARCEL' => 4,
        'ONLINE_PARCEL' => 23,
        'PARCEL_CLASS_1' => 47,
        'ONLINE_COURIER' => 24,
    ];


    public static function xmlToString(SimpleXMLElement $doc)
    {

        $doc = $doc->asXML();
        $result = preg_replace_callback("/(&#x[0-9ABCDEF]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $doc);
        return $result;

    }


    public static function sendApiRequest($request, $headers = [])
    {

        if (is_a($request, 'SimpleXMLElement')) $request = self::xmlToString($request);


        $headers = array_merge($headers, ['Connection: close', 'Content=Type: application/xml']);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => self::API_URL,
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

        $response = @simplexml_load_string($response);

        return $response;

    }


    public static function getToken($partner_id = self::TEST_PARTNER_ID, $password = self::TEST_PASSWORD)
    {


        $xml = new SimpleXMLElement('<create-access-token/>');
        $xml->addAttribute('partner_id', $partner_id);
        $xml->addAttribute('password', $password);

        $response = self::sendApiRequest($xml);

        return (!empty($response->{'value'})) ? strval($response->{'value'}) : '';


    }


    public static function zeroPaddingLeft($value, $length)
    {
        if (strlen($value) < $length)
            $value = str_repeat('0', $length-strlen($value)).$value;

        return $value;

    }


}