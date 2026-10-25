<?php
require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");
class ControllerToolNeoSeoText extends NeoSeoController {
 private $error = array();
    public function __construct($registry) {
        parent::__construct($registry);
        $this->_moduleSysName = "neoseo_text";
        $this->_logFile = $this->_moduleSysName . ".log";
        $this->debug = $this->config->get($this->_moduleSysName . "_debug");
    }

}