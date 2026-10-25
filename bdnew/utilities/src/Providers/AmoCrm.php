<?php

class Providers_AmoCrm {

    protected static function request($link,$reqest) {

        $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
        #Устанавливаем необходимые опции для сеанса cURL
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
        curl_setopt($curl,CURLOPT_URL,$link);
        if(!empty($reqest)){
            curl_setopt($curl,CURLOPT_POST,true);
            curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($reqest));            
        }       
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

        $data=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
        curl_close($curl); #Заверашем сеанс cURL
        return json_decode($data);
    }

    public static function registerLead($subdomain, $login, $token, $resp_user, $dealname, $zakaz) {
        
        $auth = self::Auth($subdomain, $login, $token);
        
        if(isset($auth->auth) && $auth->auth == 1){
            $lead=array(
                'name'=>$dealname,
                'status_id'=>23497333,  // незнаю как там в других акках, может придется переделать
                'price'=>0,
                'responsible_user_id'=>$resp_user,
                'tags'=>'YesCPA'
            );
            $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/leads/set';
            $set['request']['leads']['add'][]=$lead;  
            $res = self::request($link,$set);              
            $order_amo = $res->response->leads->add[0]->id;
            $addClient = self::addClient($subdomain, $zakaz->name, $zakaz->email,$zakaz->phone,$resp_user,$order_amo);
        }

        if (!isset($order_amo)) {
            throw new Exception("Не принят");
        }
        return $order_amo;
    }

    public static function getPaymentStatus($subdomain, $login, $token, $order) {
        $auth = self::Auth($subdomain, $login, $token);
        if(isset($auth->auth) && $auth->auth == 1){
            $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/leads/list?id='.$order;
            $res = self::request($link,'');
            return $res->response->leads[0]->status_id;
        }else{
            throw new Exception("Bad Request");
        }  
    }
    

    public static function getStatuses($subdomain, $login, $token, $pipeline) {
        $auth = self::Auth($subdomain, $login, $token);
        if(isset($auth->auth) && $auth->auth == 1){
            $link='https://'.$subdomain.'.amocrm.ru/api/v2/pipelines?id='.$pipeline;
            $res = self::request($link,'');
            return $res;
        }else{
            throw new Exception("Bad Request");
        }  
    }

    public static function getStatus($subdomain, $login, $token, $order) {
        $auth = self::Auth($subdomain, $login, $token);
        if(isset($auth->auth) && $auth->auth == 1){
            $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/leads/list?id='.$order;
            $res = self::request($link,'');
            return $res->response->leads[0];
        }else{
            throw new Exception("Bad Request");
        }         
    }
    
    public static function addClient($subdomain, $name, $email,$phone,$resp_user,$order_amo) {
        $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';        
        
        $account = self::AccountInfo($subdomain);
        
        $need=array_flip(array('PHONE','EMAIL'));    
        if(isset($account->custom_fields,$account->custom_fields->contacts)){
            foreach($account->custom_fields->contacts as $field){
                if(isset($field->id))
                {
                    if(isset($field->code) && isset($need[$field->code])){
                        $fields[$field->code]=(int)$field->id;
                    }
                }
            }       
        }
        $custom_fields=isset($fields) ? $fields : false;        
        
        if($custom_fields && count($custom_fields) > 0){      
            $contact=array(
                'name'=>$name,
                'responsible_user_id'=>$resp_user,
                'linked_leads_id'=>array($order_amo),              
                'custom_fields'=>array(
                    array(
                        'id'=>$custom_fields['EMAIL'],
                        'values'=>array(
                                array(
                                        'value'=>$email,
                                        'enum'=>'WORK'
                                )
                        )
                    )
                )
            );
            $contact['custom_fields'][]=array(
                'id'=>$custom_fields['PHONE'],
                'values'=>array(
                    array(
                            'value'=>$phone,
                            'enum'=>'OTHER'
                    )
                )
            );

            $set['request']['contacts']['add'][]=$contact;  
            $res = self::request($link,$set);
        }else{
            $res =0;
        }
        $res=$res->response;
        return $res;
    }
 
    public static function AccountInfo($subdomain) {     
        $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/accounts/current';
        $res = self::request($link,'');
        $account=$res->response->account;
        return $account;
    }  
    
    public static function Auth($subdomain, $login, $token) {
        $user=array(
                'USER_LOGIN'=>$login, #Ваш логин (электронная почта)
                'USER_HASH'=>$token #Хэш для доступа к API (смотрите в профиле пользователя)
        );        
        $link='https://'.$subdomain.'.amocrm.ru/private/api/auth.php?type=json';
        $res = self::request($link,$user);
        $res=$res->response;
        return $res;
    }      

}
