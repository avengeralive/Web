<?php

abstract class Controller {

    /**
     * Контейнер
     * @var DI
     */
    protected $di;

    abstract public function handleRequest(DI $di);

    public function __construct() {
        header("Content-Type:text/html;charset=utf-8");
    }

}
