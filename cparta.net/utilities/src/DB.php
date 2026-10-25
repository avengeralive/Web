<?php

/**
 * PDO Singleton
 */
class DB {

    /**
     *
     * @var type 
     */
    protected static $_inst = null;

    protected function __construct() {
        
    }

    /**
     * 
     * @return PDO
     */
    public static function getInstance() {
        if (static::$_inst) {
            return static::$_inst;
        }
        $di = Registry::get('di');
        $config = $di->db_config;
        static::$_inst = new PDO('mysql:dbname=' . $config['name'] . ';host=' . $config['host'], $config['user'], $config['pass'], [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        return static::$_inst;
    }
    public function Query($sql){
        $di = Registry::get('di');
        $config = $di->db_config;
        $connect = mysqli_connect('localhost', $config['user'], $config['pass'], 'cparta') or die("Не удалсоь присоединиться");
        $bd = mysqli_query($connect,$sql);
        return $bd;
    }

}
