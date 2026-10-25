<?php

// @TODO:: Вынести в интерфейсы
class Logger_File {

    protected $directory;

    public function __construct($directory) {
        $this->directory = $directory;
    }

    protected function write($type, $message) {
        @fwrite(@fopen($this->directory . '/' . $type, 'a'), date('r') . "\t" . $message . PHP_EOL);
    }

    public function info($message) {
        $this->write('info', $message);
    }
	
    public function amostatus($message) {
        $this->write('amostatus', $message);
    }
	
    public function warning($message) {
        $this->write('warning', $message);
    }

    public function custom( $type, $message){
        $this->write($type, $message);
    }
}
