<?php

class Stream extends Entity {

    public static function tableName() {
        return 'streams';
    }


    /**
     * Возвращает stream leadvertex
     * @return int StreamID
     */

    public function getLeadvertexStream($data){
        $name       = $data['name'];
        $goods      = (int)$data['goodID'];
        $user_id    = '';
        $sql = "SELECT id FROM users WHERE `email` LIKE '%$name@%'";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        $user_id = (int)$stmt->fetchObject()->id;

        $sql = "SELECT id FROM streams WHERE `user_id` = '$user_id' AND `goods_id_lv` = '$goods' ORDER BY id DESC LIMIT 1";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        $stream = (int)$stmt->fetchObject()->id;
        return $stream;
    }

    /**
     * Возвращает все ленды для потока
     * @return \Offer_Landing
     */
    public function getLandings() {
        $e = explode(',', $this->landing_id);
        $sql = "select * from landings where id in( " . implode(',', array_fill(0, count($e), '?')) . ')';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute($e);
        $list = [];
        while ($row = $stmt->fetchObject()) {
            $el = new Offer_Landing;
            $el->setRow($row);
            $list[] = $el;
        }
        return $list;
    }

    /**
     * Возвращает все преленды для потока
     * @return \Offer_Prelanding
     */
    public function getPrelandings() {
        $e = explode(',', $this->prelanding_id);
        $sql = "select * from prelandings where id in( " . implode(',', array_fill(0, count($e), '?')) . ')';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute($e);
        $list = [];
        while ($row = $stmt->fetchObject()) {
            $el = new Offer_Prelanding;
            $el->setRow($row);
            $list[] = $el;
        }
        return $list;
    }

    public function saveLandings($ids) {
        
    }

    public function savePreLandings($ids) {
        
    }
	
    /**
     * Постбек при добавлении заказа
     */
    public function postback(Stream $stream, Offer $offer, Zakaz $zakaz, $status) {
        $postback_url = html_entity_decode($stream->postback_url);
        $makros = ["{status}","{stream_id}","{lead_time}","{ip}","{profit}","{offer_id}","{offer_name}","{subid1}", "{subid2}", "{subid3}", "{subid4}", "{subid5}"];
        $changes = [$status,$zakaz->stream,$zakaz->date,$zakaz->ip,$zakaz->comission,$zakaz->offer_id,$offer->name,$zakaz->subid1, $zakaz->subid2, $zakaz->subid3, $zakaz->subid4, $zakaz->subid5];
        $postback_url = str_replace($makros, $changes, $postback_url);
        $postback_url = str_replace(' ', '+', $postback_url);
        //$send = file_get_contents($postback_url); 

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
/*
        $logs = new PostbackLogs();
        $logs->user_id = $zakaz->user_id;
        $logs->postback_id = 0;
        $logs->stream_id = $zakaz->stream;
        $logs->date_send = time();
        $logs->url = $postback_url;
        $logs->str = implode('|', $vars);
        $logs->create();
*/      $time = time() ;
        $Job = new postbackRequests();
        $Job->user_id = $zakaz->user_id;
        $Job->stream_id = $zakaz->stream;
        $Job->created = $time;
        $Job->status = 'new';
        $Job->nextTimeRequest = $time;
        $Job->retries = 0;
        $Job->url = $postback_url;
        $Job->postData = implode('|', $vars);
        $Job->type_send = 1;
        $Job->create();               
		return 1;
    }    
	
    public function getMyOffers($user_id) {  
        $list = array();
        $db = DB::getInstance();
        $sql = "select distinct(offer_id) from streams where user_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id));
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row['offer_id'];
        }
        return $list;           
    }
}
