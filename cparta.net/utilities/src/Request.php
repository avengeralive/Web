<?php

class Request {

    protected $_data = array();

    public function __construct(&$arr) {
        $this->_data = $arr;
    }

    public function __get($name) {
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }
        return null;
    }

    public function __set($name, $value) {
        $this->_data[$name] = $value;
        return $value;
    }

    public function __isset($name) {
        return isset($this->_data[$name]);
    }

}
