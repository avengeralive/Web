<?php

namespace App;

use Carbon\Carbon;

class OData
{
    public static $host = 'http://rent1c.com:35434/poseidonErp/odata/standard.odata/';
    public static $username='apiv1';
    public static $password='ecZj5S2Lu4W---';
    public static $type = [
        'orders' => ['u' => 'Document_арусЗаданиеНаТрансфер', 's'=>'*'],
        'quest' => ['u' => 'Document_арусЗаданиеНаТрансфер_Маршрут', 's'=>'*'],
        'otv' => ['u' => 'Catalog_Пользователи', 's'=>'Description'],
        'car' => ['u' => 'Catalog_арусТранспортныеСредства', 's'=>'*'],
        'mCar' => ['u' => 'Catalog_арусМаркиТранспортныхСредств', 's'=>'Code,КатегорияМеста_Key,Owner_Key'],
        'tCar' => ['u' => 'Catalog_арусТипыТранспортныхСредств', 's'=>'Description,Мест'],
        'cmCar' => ['u' => 'Catalog_арусКатегорииМест', 's'=>'Description'],
        'driver' => ['u' => 'Catalog_КонтактныеЛицаПартнеров', 's'=>'*'],
        'city' => ['u' => 'Catalog_арусГорода', 's'=>'Description'],
        'pass' => ['u' => 'Catalog_арусПассажиры', 's'=>'Description,КонтактнаяИнформация'],
        'contr' => ['u' => 'Catalog_Контрагенты', 's'=>'Description'],
    ];

    public function __construct()
    {

    }

    public static function get($type, $id=null,$filter=null) {
        date_default_timezone_set('Europe/Moscow');

        $query = urlencode(self::$type[$type]['u']);
        if($id) {
            $query .= "(guid'$id')";
        }
        $query .= '?$select='.urlencode(self::$type[$type]['s']);
        if($filter) {
            $query .= '&$filter='.str_replace(' ', '%20',$filter);
            $query = str_replace("'", '%27',$query);
        }
        $query .= ('&$format=json;odata=nometadata');
		var_dump(self::$host.($query));
        return self::curl(self::$host.($query));
    }
    public static function getMax($type, $id=null,$filter=null,$expand=null,$response=null) {
        date_default_timezone_set('Europe/Moscow');

        $query = urlencode(self::$type[$type]['u']);
        if($id) {
            $query .= "(Ref_Key=guid'".$id."')";

        }
        $query .= '?$select='.urlencode(self::$type[$type]['s']);
        if($filter) {
            $query .= '&$filter='.str_replace(' ', '%20',$filter);
            $query = str_replace("'", '%27',$query);
        }
        $query .= ('&$format=json');

        if($expand) {
            $query .= '&$expand='.urlencode($expand);

        }
        if($response) {
            return $query;
        }
        return self::curlMax(self::$host.($query));
    }

    public static function set($type, $id, $data = []) {
        date_default_timezone_set('Europe/Moscow');

        $query = urlencode(self::$type[$type]['u']);
        if($id) {
            $query .= "(Ref_Key=guid".$id.", LineNumber=1)";
        }
        return self::curl(self::$host.($query));
    }

    public static function setMax($type, $id, $data = []) {
        date_default_timezone_set('Europe/Moscow');

        $query = urlencode(self::$type[$type]['u']);
        if($id) {
            $query .= "(Ref_Key=guid'".$id."')";
        }

        $query .= ('?$format=json');
        return self::curlMax(self::$host.($query),$data);
    }

    public static function cd($date){
        return Carbon::createFromFormat('Y-m-d\TH:i:s',$date)->toDateTimeString();
    }

    public static function data($data)
    {
        date_default_timezone_set('Europe/Moscow');
        $str = '';
        foreach($data as $k => $d) {
            switch ($k) {
                case 'status':
                    $str .= '<d:Статус>'.$d."</d:Статус>";
                    break;
                case 'start':
                    $str .= '<d:ВремяПодачиФакт>'.$d."</d:ВремяПодачиФакт>";
                    break;
                case 'end':
                    $str .= '<d:ВремяПрибытияФакт>'.date('Y-m-d\TH:i:s')."</d:ВремяПрибытияФакт>";
                    break;
                case 'driver':
                    $str .= '<d:Водитель_Key>'.$d."</d:Водитель_Key>";
                    $str .= '<d:ТранспортноеСредство_Key>'.$d."</d:ТранспортноеСредство_Key>";
                    break;
            }
        }

         $entry = '<?xml  version="1.0" encoding="UTF-8"?>
        <entry  xmlns="http://www.w3.org/2005/Atom" xmlns:d="http://schemas.microsoft.com/ado/2007/08/dataservices" xmlns:m="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata" xmlns:georss="http://www.georss.org/georss" xmlns:gml="http://www.opengis.net/gml">
                      <content type="application/xml">
                          <m:properties>
                             '.$str.'
                           </m:properties>
                       </content>
                    </entry> 
        ';
//        echo $entry;
        return $entry;
    }

    public static function curl($url, $data = '')
    {
    	//return $data;
        date_default_timezone_set('Europe/Moscow');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_COOKIEFILE,storage_path().'/cookies/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($ch,CURLOPT_COOKIEJAR,storage_path().'/cookies/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($ch, CURLOPT_USERPWD, self::$username . ":" . self::$password);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, [ "Authorization: Basic ".base64_encode(self::$username.":".self::$password), ]);
        $headers[] = "Authorization: Basic ".base64_encode(self::$username.":".self::$password);
        //$headers[] = '';
        if(!empty($data)) {
            $headers[] = 'Content-Type: application/atom+xml';
            $headers[] = 'Accept: application/atom+xml';
            $headers[] = "Accept-Charset: UTF-8";
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        echo $result=curl_exec ($ch);
        $status_code = curl_getinfo($ch);   //get status code
        curl_close ($ch);
        return $res = json_decode($result);
    }

    public static function curlMax($url, $data = '')
    {
        date_default_timezone_set('Europe/Moscow');
        $f = fopen('logscurl.txt', 'ab');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_COOKIEFILE,storage_path().'/cookies/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($ch,CURLOPT_COOKIEJAR,storage_path().'/cookies/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_STDERR, $f);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, [ "Authorization: Basic ".base64_encode(self::$username.":".self::$password), ]);
        $headers[] = "Authorization: Basic ".base64_encode(self::$username.":".self::$password);
        $headers[] = 'Accept: application/atom+xml,application/xml';
        $headers[] = "Accept-Charset: UTF-8";
        $headers[] = "1C_OData_DataLoadMode: true";

        if(!empty($data)) {
            $headers[] = 'Content-Type: application/atom+xml';
            $headers[] = 'Accept: application/atom+xml,application/xml';
            $headers[] = "Accept-Charset: UTF-8";
            $headers[] = "1C_OData_DataLoadMode: true";
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result=curl_exec ($ch);
        curl_close ($ch);

        return $result;
        $status_code = curl_getinfo($ch);   //get status code
        return $res = json_decode($result);
    }
}
