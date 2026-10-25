<pre><?php
    $ip = '196.138.69.42';
    //$ip = '104.45.18.178';
    $ip = '145.255.177.238';
    include("SxGeo/SxGeo.php");
    include("browser_detect.php");
    include("mobile_detect.php");
    $SxGeo = new SxGeo();
    $region_full = $SxGeo->getCityFull($ip);
    if (isset($region_full['region']['iso']) && in_array($region_full['region']['iso'], ['UA-40', 'UA-43'])) {
        $region_full['country'] = array(
            'id' => 185,
            'iso' => 'RU',
            'lat' => 60,
            'lon' => 100,
            'name_ru' => 'Россия',
            'name_en' => 'Russia',
        );
    }
    var_export($region_full);
    var_dump($SxGeo->getCountry($ip));
    