<?php

class Geo {

    public static function getInfoByIp($ip) {
        require_once (dirname(__FILE__) . '/../../modules/detectclient/SxGeo/SxGeo.php'); // @TODO: Не очень хорошо так делать :(
        $SxGeo = new SxGeo();
        $region_full = $SxGeo->getCityFull($ip);
        if (!$region_full) {
            throw new Exception("Ip cannot be detect");
        }
        return $region_full;
    }

}
