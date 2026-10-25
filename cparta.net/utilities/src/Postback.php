<?php

class Postback extends Entity {

    public static function tableName() {
        return 'postback';
    }
    
    public static function getByUserId($user_id){
        $db = DB::getInstance();        
        $sql = "select * from postback where user_id =".$user_id." LIMIT 1";
        $stmt = $db->query($sql);
        if ($stmt->rowCount() == 0) {
            return null;
        }
        $el = new static();
        $el->setRow($stmt->fetchObject());
        return $el;    
    } 
    
    public static function getByStream($streamId){
        $db = DB::getInstance();        
        $sql = "select * from postback where stream =".$streamId." LIMIT 1";
        $stmt = $db->query($sql);
        if ($stmt->rowCount() == 0) {
            return null;
        }
        $el = new static();
        $el->setRow($stmt->fetchObject());
        return $el;  
    } 
    
    public function sendPostback(Offer $offer, Zakaz $zakaz, $status) {
        $time = time() ;
        $postback = self::getByUserId($zakaz->user_id);
        $postback_url = $postback->url;        
        $makros = ["{status}","{id}","{stream_id}","{lead_time}","{ip}","{profit}","{offer_id}","{offer_name}","{subid1}", "{subid2}", "{subid3}", "{subid4}", "{subid5}", "{1v1}"];
        $changes = [$status,$zakaz->id,$zakaz->stream,$zakaz->date,$zakaz->ip,$zakaz->comission,$zakaz->offer_id,$offer->name,$zakaz->subid1, $zakaz->subid2, $zakaz->subid3, $zakaz->subid4, $zakaz->subid5, $zakaz->pinger_value];
        $postback_url = str_replace($makros, $changes, $postback_url);
        $postback_url = str_replace(' ', '+', $postback_url);
		
        $vars['order'] = $zakaz->id;
        $vars['status'] = $status;
        $vars['stream_id'] = $zakaz->stream;
        $vars['lead_time'] = $zakaz->date;
        $vars['ip'] = $zakaz->ip;
        $vars['profit'] = $zakaz->comission;
        $vars['offer_id'] = $zakaz->offer_id;
        $vars['offer_name'] = $offer->name;
        $vars['subid1'] = $zakaz->subid1;
        $vars['subid2'] = $zakaz->subid2;
        $vars['subid3'] = $zakaz->subid3;
        $vars['subid4'] = $zakaz->subid4;
        $vars['subid5'] = $zakaz->subid5;
		$vars['1v1'] = $zakaz->pinger_value;
/*
        $ch = curl_init($postback_url);
        if ($postback->type_send == 2) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($ch);   
       
        $logs = new PostbackLogs();
        $logs->user_id = $zakaz->user_id;
        $logs->postback_id = $postback->id;
        $logs->stream_id = $zakaz->stream;
        $logs->date_send = time();
        $logs->url = $postback_url;
        $logs->str = implode('|', $vars);
        $logs->create();
*/         
        $Job = new postbackRequests();
        $Job->user_id = $zakaz->user_id;
        $Job->postback_id = $postback->id;
        $Job->stream_id = $zakaz->stream;
        $Job->created = $time;
        $Job->status = 'new';
        $Job->nextTimeRequest = $time;
        $Job->retries = 0;
        $Job->url = $postback_url;
        $Job->postData = implode('|', $vars);
        $Job->type_send = $postback->type_send;
        $Job->create();        
    }  
   
}
