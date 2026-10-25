<?php

abstract class Mailing_Sender {

    protected $_config = [];

    public function __construct($config = false) {
        $this->_config = $config;
    }

    /**
     * Письмо для отправки
     * @var Mailing_Letter
     */
    protected $letter;

    public function setLetter(Mailing_Letter $letter) {
        $this->letter = $letter;
        return $this;
    }

    abstract function send(Mailing_Letter $letter = null);

    /**
     * 
     * @param type $type
     * @param type $config
     * @return \Mailing_Sender
     * @throws Exception
     */
    public static function factory($type, $config = false) {
        if ($type == 'phpmailer') {
            return new Mailing_Sender_PHPMailer($config);
            
        }
        throw new Exception("No type / " . $type . "/ found");
    }
    /**
     * Получить стандартный отправщик
     * @return \Mailing_Sender
     */
    public static function getDefaultSender(){
        $di = Registry::get('di');
        $mailer = $di->mailer;
        return static::factory($mailer['type'], $mailer['config']);
        
    }

}
