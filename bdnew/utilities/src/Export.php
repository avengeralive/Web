<?php

abstract class Export {

    /**
     *
     * @var DI
     */
    protected $di;

    /**
     *
     * @var PDO
     */
    protected $db;

    abstract public function getExported();
    
    public static function factory($type) {
        if ($type == 'cpad') {
            return new Export_Cpad;
        }
        if ($type == 'ats') {
            return new Export_Advansets;
        }
        throw new Exception("No type / " . $type . " / for export");
    }

    public function __construct() {
        $this->db = DB::getInstance();
        $this->di = Registry::get('di');
    }

    
}
