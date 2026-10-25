<?php

use GeoIp2\WebService\Client;

class Detector {

    private $data;

    public function get($param) {
        return $this->data[$param];
    }

    public function detect() {

        include_once(dirname(__FILE__) . "/SxGeo/SxGeo.php");
        include_once(dirname(__FILE__) . "/browser_detect.php");
        //include_once(dirname(__FILE__) . "/mobile_detect.php");

// Detect IP
        $this->data['ip'] = '';
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $this->data['ip'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $this->data['ip'] = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (isset($_SERVER["REMOTE_ADDR"])) {
            $this->data['ip'] = $_SERVER["REMOTE_ADDR"];
        }
        if (isset($_SERVER["HTTP_X_REAL_IP"])) {
            $this->data['ip'] = $_SERVER["HTTP_X_REAL_IP"];
        }
        if (isset($_GET['_xcountry'])) {
            if ($_GET['_xcountry'] == 'UA') {
                $this->data['ip'] = '178.151.149.' . rand(1, 254); //178.151.149.227
            }
            if ($_GET['_xcountry'] == 'RU') {
                $this->data['ip'] = '195.206.48.' . rand(1, 254); //195.206.48.17
            }
            if ($_GET['_xcountry'] == 'BY') {
                $this->data['ip'] = '95.46.30.' . rand(1, 254); //95.46.30.18
            }
            if ($_GET['_xcountry'] == 'KZ') {
                $this->data['ip'] = '88.204.163.' . rand(1, 254); // 88.204.163.13
            }
            if ($_GET['_xcountry'] == 'AM') {
                $this->data['ip'] = '37.186.125.' . rand(1, 254); // 37.186.125.207
            }
            if ($_GET['_xcountry'] == 'PL') {
                $this->data['ip'] = '62.181.' . rand(1, 31).'.' . rand(1, 254); // 37.186.125.207
            } 
            if ($_GET['_xcountry'] == 'AE') {
                $this->data['ip'] = '94.58.128.' . rand(1, 254); // 37.186.125.207
            }  
            if ($_GET['_xcountry'] == 'KG') {
                $this->data['ip'] = '212.112.101.' . rand(1, 254); //178.151.149.227
            }
            if ($_GET['_xcountry'] == 'ES') {
                $this->data['ip'] = '81.42.194.' . rand(1, 254); //178.151.149.227
            }
            if ($_GET['_xcountry'] == 'ID') {
                $this->data['ip'] = '103.19.110.' . rand(1, 254); //178.151.149.227
            }
            if ($_GET['_xcountry'] == 'GR') {
                $this->data['ip'] = '31.217.181.' . rand(1, 254); //178.151.149.227
            }
        }
        if (isset($_GET['_xip'])) {
            $this->data['ip'] = $_GET['_xip'];
        }


        if (!isset($_SERVER["HTTP_REFERER"]) || $_SERVER["HTTP_REFERER"] == '') {
            $this->data['referer'] = '';
        } else {
            $this->data['referer'] = $_SERVER["HTTP_REFERER"];
        }

        if (!isset($_SERVER["HTTP_USER_AGENT"]) || $_SERVER["HTTP_USER_AGENT"] == '') {
            $this->data['agent'] = '';
        } else {
            $this->data['agent'] = $_SERVER["HTTP_USER_AGENT"];
        }

        $browser = new browser_detect($this->data['agent']);
        $this->data['browser_name'] = $browser->getBrowser();
        $this->data['browser_ver'] = $browser->getVersion();

        $this->data['platform'] = $browser->getPlatform();

        // Detect type advice
        $mobile = new Mobile_Detect;
        if ($mobile->isMobile() or $mobile->isTablet()) {
            $this->data['mobile'] = '1';
        } else {
            $this->data['mobile'] = '0';
        }

        // Detect country
        $SxGeo = new SxGeo();
        $kr = false;
        $region_full = $SxGeo->getCityFull($this->data['ip']);
        if ($region_full) {
            $this->data['country_code'] = $SxGeo->getCountry($this->data['ip']);
            $this->data['country'] = $region_full['country']['name_ru'];
        } else {
            // maxmind


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

            $maxmind = Registry::get('di')->maxmind;

            try {
                $client = new Client($maxmind['id'], $maxmind['key']);
                $record = $client->city($this->data['ip']);
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
            $region_full = $struct;
            $this->data['country_code'] = $region_full['country']['iso'];
            $this->data['country'] = $region_full['country']['name_ru'];
        }
        if (isset($region_full['region']['iso']) && in_array($region_full['region']['iso'], ['UA-40', 'UA-43'])) {
            $kr = true;
            $region_full['country'] = array(
                'id' => 185,
                'iso' => 'RU',
                'lat' => 60,
                'lon' => 100,
                'name_ru' => 'Россия',
                'name_en' => 'Russia',
            );
        }
        if ($kr) {
            $this->data['country_code'] = 'RU';
            $this->data['country'] = 'Россия';
        }


// Detect region
        $this->data['region'] = $region_full['region']['name_ru'];

// Detect town
        $this->data['city'] = $region_full['city']['name_ru'];
    }

}

$detector = new Detector();
$detector->detect();
