<?php

class Offer_Pinger_LeadVertexProElite extends Offer_Pinger {
    
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    public function ping($settings, \Zakaz $zakaz) {
        list($id_l, $sub, $token) = explode(',', $settings);
        $offer = Offer::getById($zakaz->offer_id);

        $id = Providers_LeadVertexProElite::registerLead($zakaz, $offer->name, $id_l);

        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $id
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        list($id, $sub, $token) = explode(',', $zakaz->pinger_value);

        $status = Providers_LeadVertexProElite::getPaymentStatus($sub, $token, $id);
        if ($status == '-1') {
            $zakaz->update(['addstatus'=>5]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == '1') {
            $zakaz->update(['addstatus'=>4]);
            return true; //ничего не сменилось, статус=1
        }
        
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        $id = $zakaz->pinger_value;
        $res = Providers_LeadVertexProElite::getStatus($id);
        $status = $res->statusGroup;
        $comments = $res->comment;

        if ($status === NULL) {
            return true; //статусы закрыты
        }		

        if ($status == 'processing') {
            $zakaz->update(['comments'=>$comments]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'canceled') {
            self::requestLV($zakaz,$comments,0);
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'spam') {
            self::requestLV($zakaz,$comments,9);
            $status = Zakaz::STATUS_TRASH;
        } elseif ($status == 'accepted' || $status == 'paid') {

            self::requestLV($zakaz,$comments,1);
            $status = Zakaz::STATUS_APPROVED;
            self::send_1v1($zakaz,$res,$comments);
        }
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    function send_1v1(\Zakaz $zakaz,$items,$comments){
        $bd = new mysqli('localhost','cpa','Q1h4F4s3','cpa');
        $bd -> query('SET names utf8');
        
        $field = $items;

        $sql = "SELECT * FROM `offers_owner` WHERE `pinger_type` = 'Offer_Pinger_1v1' AND `offer_id` = '{$zakaz->offer_id}'";
        $offers_owner = $bd->query($sql);
        if(mysqli_num_rows($offers_owner)>0){
            $res                        = $offers_owner->fetch_assoc();
            $vars                       = array();
            $vars['fio']                = $items->fio;
            $vars['phone']              = $items->phone;
            $vars['comment']            = $items->comment;
            $vars['ip']                 = $zakaz->ip;
            $vars['country']            = $zakaz->country;
            $vars['region']             = $items->region;
            $vars['city']               = $items->city;
            $vars['address']            = $items->address;
            $vars['webmasterId']        = $zakaz->user_id;
            $vars['offerID']            = $res['pinger_value'];
            $vars['domain2']            = $zakaz->referer;
            $vars['externalId']         = $zakaz->id;
            $vars['externalWebmaster']  = $zakaz->externalWebmaster;
            $vars['externalWebmaster2'] = $zakaz->externalWebmaster2;
            $vars['rekl']               = $res['owner_id'];
            $vars['postIndex']          = $items->postIndex;
            $vars['size']               = $items->quantity;
            $vars['total']              = $items->total;
            
            $url = 'https://1v1-crm.ru/json/?func=api&action=cpa_approved';
            $url .= '&' . http_build_query($vars);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $data = curl_exec($ch);
        }
    }

}
