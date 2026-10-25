<?php

class DI {

    protected $_data = array();

    /**
     * Установка переменной
     * @param string $name
     * @param mixed $data
     * @return \DI
     */
    public function set($name, $data = false) {
        $this->_data[$name] = $data;
        return $this;
    }

    public function get($name) {
        if (!isset($this->_data[$name])) {
            return null;
        }
        return $this->_data[$name];
    }

    public function __get($name) {
        return $this->get($name);
    }

    /**
     * 
     * @param type $name
     * @param type $value
     * @return type
     */
    public function __set($name, $value) {
        return $this->set($name, $value);
    }

}
