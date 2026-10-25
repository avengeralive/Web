<?php

class Client {

    public $ip = '';
    public $id = '';
    public $browser = '';
    public $browser_version = '';
    public $is_mobile = 0;
    public $country = '';
    public $country_short = '';
    public $city = '';
    public $region = '';
    public $referer = '';
    public $referer_host = '';
    public $useragent = '';
    public $name = '';
    public $phone = '';
    public $email = '';
    public $address = '';
    public $street = '';
    public $dom = ''; // 
    public $platform;
    
    public $metric_online = 0;
    public $paste = 0;

    public function autoDetect() {
        
    }

}
