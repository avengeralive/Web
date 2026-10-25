<?php
namespace lib;

class Geo {

    public static function getInfoByIp($ip) {
        $SxGeo = new SxGeo();
        $region_full = $SxGeo->getCityFull($ip);
        if (!$region_full) {
            return "Ip cannot be detect";
        }
        $infoIso = $region_full['region']['iso'];
        $contime = JBase::Query("SELECT * FROM `sxgeo` WHERE `iso` = '$infoIso' ");
        $restime = $contime->fetch_assoc();
        $pos = strpos($restime['GMT'], '+');
        if($pos === false){
			$unixtime = 0;
		}else{
			$unixtime =  60 * (int)$restime['GMT'];
        }
        
        return $unixtime;
    }

    public static function testGetInfoByIp($ip) {
        $SxGeo = new SxGeo();
        $region_full = $SxGeo->getCityFull($ip);
        if (!$region_full) {
            return "Ip cannot be detect";
        }
        
        return $region_full;
    }

}
