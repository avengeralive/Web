<?php

class Registry {

    protected static $_data = array();

    public static function get($name) {
        if (!isset(static::$_data[$name])) {
            return null;
        }
        return static::$_data[$name];
    }

    public static function set($name, $value = false) {
        static::$_data[$name] = $value;
    }

}
