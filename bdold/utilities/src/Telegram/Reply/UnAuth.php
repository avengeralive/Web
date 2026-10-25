<?php

class Telegram_Reply_UnAuth {

    protected $_commands = [];

    public function __construct($cmds=[]) {
        array_walk_recursive( $cmd, function(Telegram_Command $el) use ($this){
            $this->_commands[]= $el->__toString();
        });
    }
    public function check();
    public function export(){
        return $this->_commands;
    }

}
