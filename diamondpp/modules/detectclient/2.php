<?php

require '../../utilities/bootstrap.php';
$p = '996772178284';
$c= Utils_Phones::getCountryCodeByPhone($p);
var_dump($c);

exit;
echo "<pre>";
$ip = '104.45.18.178';
$ip = '104.254.215.31';
//$ip = '196.138.69.42';

use GeoIp2\WebService\Client;
$maxmind = Registry::get('di')->maxmind;
$client = new Client($maxmind['id'], $maxmind['key']);
$record = $client->city($ip);
$struct = [
    'city' => [
        'id' => 0,
        'lat' => 0,
        'lon' => 0,
        'name_ru' => '',
        'name_en' => '',
    ],
    'region' => [
        'id' => '',
        'name_ru' => '',
        'name_en' => '',
        'iso' => '',
    ],
    'country' => [
        'id' => '',
        'iso' => '',
        'lat' => 0,
        'lon' => 0,
        'name_ru' => '',
        'name_en' => '',
    ]
];



// walk country
try {
    if (isset($record->country->isoCode)) {
        $iso = $record->country->isoCode;
        $stmt = DB::getInstance()->prepare('select * from sxgeo_country where iso=?');
        $stmt->execute([ $iso]);
        if ($stmt->rowCount() == 0) {
            throw new Exception;
        }
        $row = $stmt->fetchObject();
        $struct['country']['id'] = intval($row->id);
        $struct['country']['iso'] = $row->iso;
        $struct['country']['lat'] = floatval($row->lat);
        $struct['country']['lon'] = floatval($row->lon);
        $struct['country']['name_ru'] = $row->name_ru;
        $struct['country']['name_en'] = $row->name_en;


        if (isset($record->subdivisions[0]->isoCode)) {
            $iso = $record->subdivisions[0]->isoCode;
            $iso2 = $row->iso . '-0' . $iso;
            $iso = $row->iso . '-' . $iso;
            $stmt = DB::getInstance()->prepare("select * from sxgeo_regions where iso=? or iso=?");
            $stmt->execute([ $iso, $iso2]);
            if ($stmt->rowCount() == 0) {
                throw new Exception();
            }
            $row = $stmt->fetchObject();
            $struct['region']['id'] = intval($row->id);
            $struct['region']['name_ru'] = $row->name_ru;
            $struct['region']['name_en'] = $row->name_en;
            $struct['region']['iso'] = $row->iso;
        }
        if (isset($record->city)) {
            $id = $record->city->geonameId;
            $stmt = DB::getInstance()->prepare("select * from sxgeo_cities where id=?");
            $stmt->execute([$id]);
            if ($stmt->rowCount() == 0) {
                throw new Exception;
            }
            $row = $stmt->fetchObject();
            $struct['city']['id'] = intval($row->id);
            $struct['city']['lat'] = floatval($row->lat);
            $struct['city']['lon'] = floatval($row->lon);
            $struct['city']['name_ru'] = $row->name_ru;
            $struct['city']['name_en'] = $row->name_en;
        }
    }
} catch (Exception $e) {
    
}



var_export($struct);
