<?php

class Api_Response {

    const STATUS_SUCCESS = 200;
    const STATUS_BADREQUEST = 400;
    const STATUS_NOTFOUND = 404;
    const STATUS_DENY = 403;

    public $status;
    protected $reply = [];

    public function __construct() {
        $this->reply['status'] = self::STATUS_SUCCESS;
        header("Content-Type:application/json;charset=utf-8");
    }

    public function drop($message, $code = self::STATUS_NOTFOUND) {
        $this->reply['error'] = $message;
        $this->reply['status'] = $code;
        return $this;
    }

    public function __toString() {
        
        return json_encode($this->reply, JSON_PRETTY_PRINT);
    }

    public function __set($name, $value) {
        $this->reply[$name] = $value;
        return $this;
    }

}
