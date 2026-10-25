<?php
require_once( DIR_SYSTEM . "/engine/neoseo_controller.php");

class ControllerToolNeoSeoBlog extends NeoSeoController {
	private $error = array();

	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleName = "";
		$this->_moduleSysName = "neoseo_blog";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get( $this->_moduleSysName . "_status") == 1;
	}

}
?>