<?php

class Api_Request {

    /**
     *
     * @var Request
     */
    protected $req;

    public function __construct(Request $req) {
        $this->req = $req;
    }

    public function __get($name) {
        return $this->req->$name;
    }

    public function validate($name, $type = false) {
        if (!isset($this->req->$name)) {
            throw new Exception("[$name] required", Api_Response::STATUS_BADREQUEST);
        }
        if ($type) {
            if ($type == 'int' && !is_numeric($this->req->$name)) {
                throw new Exception("[$name] must be number", Api_Response::STATUS_BADREQUEST);
            }
            if(is_callable($type)){
                if(!$type($this->req->$name)){
                    throw new Exception("[$name] wrong format", Api_Response::STATUS_BADREQUEST);
                }
            }
        }
        return $this;
    }

}
