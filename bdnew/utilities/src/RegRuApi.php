<?php

class RegRuApi {

    protected $_config = [];
    
    public function __construct($config = false) {
        $di = Registry::get('di');
        $regru_conf = $di->regru;
        $this->_config = $regru_conf;
    }
    
    public function checkDomain($domain) {
        $req = [];
        $req['url'] = 'https://api.reg.ru/api/regru2/domain/check';
        $req['headers'] = '';
        $req['post'] = [
            'domain_name' => $domain,
            'username' => $this->_config['login'],
            'password' => $this->_config['pass'],
        ];
        $res = self::request($req);
        return json_decode($res);
    }

    public function buyDomain($domain, $user_ip, $type) {
        $req = [];
        $req['url'] = 'https://api.reg.ru/api/regru2/domain/create';
        $req['headers'] = '';
        
        if($type == 1){
            $profile_type = $this->_config['profile_type_ru'];
        }else{
            $profile_type = $this->_config['profile_type_en'];
        }
        
        $req['post'] = [
            'username' => $this->_config['login'],
            'password' => $this->_config['pass'],
            'domain_name' => $domain,
            'profile_type' => $profile_type,
            'profile_name' => $profile_name,
            'enduser_ip' => $user_ip,
            'ns0' => 'ns1.reg.ru',
            'ns1' => 'ns2.reg.ru',
        ];
        $res = self::request($req);
        $res = json_decode($res);
        
        $service_id = $res->answer->service_id;
        $res = self::addIp($service_id);
        
        return json_decode($res);
    }

    public function addIp($service_id) {
        $req = [];
        $req['url'] = 'https://api.reg.ru/api/regru2/zone/add_alias';
        $req['headers'] = '';
        $req['post'] = [
            'username' => $this->_config['login'],
            'password' => $this->_config['pass'],
            'subdomain' => '@',
            'ipaddr' => $this->_config['ipaddr'],
            'service_id' => $service_id,
        ];
        $res = self::request($req);
        return json_decode($res);
    }
    
    public function request($param) {
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $param['url']);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $param['headers']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($param['post']));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $responseBody = curl_exec($curl);
        curl_close($curl);
        
        return $responseBody;
        
        
    }
    
}
