<?php

class Utils_Client {

    public static function getSexByName($name) {
        if ($name == '') {
            return ['name' => '', 'sex' => 0];
        }
        $encoding = 'UTF-8';
        $arr = explode(" ", $name);
        $count = count($arr);
        $name = '';
        $sex = 0;

        foreach ($arr as $num => $val) {

            $str = preg_replace("/[^a-zа-яё]+/iu", "", $val);
            $str = ucfirst($str);
            $space = ($count > 1) ? ' ' : '';

            $name .= $str . $space;
            $sex = (!$sex) ? self::SearchName($str) : $sex;
        }

        $array['name'] = $name;
        $array['sex'] = $sex;

        return $array;
    }

    protected static function SearchName($name) {
        $db = DB::getInstance();

        return 0;
        
        $names = array('Саша', 'Женя', 'Валя', 'Слава');


        if (in_array($name, $names)) {
            $sex = 0;
        } else {
            $stmt = $db->prepare("SELECT Sex FROM z_russian_names where Name = ?");
            $stmt->execute([ $name]);
            if ($stmt->rowCount() == 0) {
                return 0;
            }

            $sql['Sex'] = $stmt->fetchColumn();
            if ($sql['Sex'] == 'М') {
                $sex = 1;
            } elseif ($sql['Sex'] == 'Ж') {
                $sex = 2;
            } else {
                $sex = 0;
            }
        }

        return $sex;
    }

}
