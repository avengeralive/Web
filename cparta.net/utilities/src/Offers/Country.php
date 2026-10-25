<?php

class Offers_Country extends Entity{

    public static function tableName() {
        return 'sxgeo_country';
    }
    public static function getNamesByIso($array, $language = false) {
        if (empty($array)) {
            return array();
        }
        if ($language != 'ru' && $language != 'en') {
            $language = 'ru';
        }
        $sql = "select iso, name_" . $language . " as name from sxgeo_country where iso in (" . implode(",", array_fill(0, count($array), '?')) . ") order by iso asc";
        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute($array);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $list = array();
        foreach ($data as $row) {
            $list[$row->iso] = $row->name;
        }
        return $list;
    }

    public static function getCurrencyByIso($iso) {
        $db = DB::getInstance();
        return ($a = $db->query("select currency_iso from sxgeo_country where iso=" . $db->quote($iso))->fetchColumn()) ? $a : '';
    }

    public static function getUseCountry($onlyActive = true) {
        $db = DB::getInstance();
        $sql = "select distinct(geo) as geo from offers ";
        if ($onlyActive) {
            $sql.= "where active=1";
        }

        $stmt = $db->query($sql)->fetchAll(PDO::FETCH_OBJ);
        $list = array();
        foreach ($stmt as $row) {
            $tmp = explode("|", $row->geo);
            if ($tmp[0] == '')
                continue;
            $country_list = explode(":", $tmp[0]);
            foreach ($country_list as $country) {
                if (!preg_match("/^[A-Z]{2}$/", $country))
                    continue;
                $list[$country] = true;
            }
        }
        return array_keys($list);
    }

}
