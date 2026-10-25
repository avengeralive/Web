<?php

abstract class Telegram_Command {

    protected $_name = '';

    public function __toString() {
        return $this->_name;
    }

    abstract public function run($message);
    
}
